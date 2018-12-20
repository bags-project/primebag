<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderContent;
use App\Service\CartService;
use App\Service\OrderService;
use App\Service\ArticleService;
use App\Service\OrderStatusService;
use App\Service\PaymentMethodService;
use App\Service\UserService;
use App\Service\CarrierService;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Validator\Constraints\Date;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class OrderController extends AbstractController
{
    private $orders;


    /**
     * @Route("/buy", name="order_valid")
     */
    public function validOrder(SessionInterface $session, CartService $cartService, Request $request)
    {
        // calcul du total panier
        $totalCart = $cartService->calculateCartTotal($session);

        return $this->render('order/buy.html.twig', [
            //'date' => $date,
            'totalCart' => $totalCart

        ]);
    }



    /**
     * @Route("/buy/success", name="order_success")
     */
    public function confirmValidatedOrder(SessionInterface $session, Request $request, UserService $userService,
                                    CartService $cartService, OrderService $orderService, 
                                    ArticleService $articleService, CarrierService $carrierService,
                                    OrderStatusService $orderStatusService, PaymentMethodService $paymentMethodService, \Swift_Mailer $mailer)
    {
        //////////////////////////////////////////
        //              PAIEMENT                //
        //////////////////////////////////////////

        //var_dump($request->request->all());
            // array (size=2)
            // 'stripeToken' => string 'tok_1DiqqXCDiJ3Czp9nLqosnDmC' (length=28)
            // 'modeLivraison' => string 'colissimo' (length=9)
        
        $totalCosts = "";
        // calcul du total panier
        $totalCart = $cartService->calculateCartTotal($session);

        //calcul du montant total incluant les frais de livraison
        $resultRequest = $request->request->all();
        switch ($resultRequest['modeLivraison']) {
            case 'colissimo':
                $shippingCost = 5;
                $idCarrier = 1; //la poste
                $totalCosts = ($totalCart + $shippingCost) * 100; // *100 car unité par défaut en centimes
                //pour pouvoir afficher la fouchette du délai de livraison
                $in1days = new \DateTime('+ 1day');//date('Y-m-d H:m:s', strtotime('+1 day'));
                $in8days = new \DateTime('+ 8day');//date('Y-m-d H:m:s', strtotime('+8 day'));
                break;
            case 'chronopost':
                $shippingCost = 10;
                $idCarrier = 1; //la poste
                $totalCosts = ($totalCart + $shippingCost) * 100;
                $in1days = new \DateTime('+ 1day');//date('Y-m-d H:m:s', strtotime('+1 day'));
                $in3days = new \DateTime('+ 3day');//date('Y-m-d H:m:s', strtotime('+3 day'));
                break;
            case 'retraitMag':
                $shippingCost = 0;  
                $idCarrier = 2; //magasin
                $totalCosts = $totalCart * 100;
                break;
        }

        ////////////// Instantiation du débit Stripe ////////////////
        \Stripe\Stripe::setApiKey("sk_test_IbRJdPR6m2D43LVKjP9zHJa5");        

        \Stripe\Charge::create([
            "amount" => $totalCosts,//2000, // en centimes
            "currency" => "eur",
            "source" => $resultRequest['stripeToken'],//$request->request->get('stripeToken'), // obtained with Stripe.js
            "description" => "Paiement de (nom) pour la commande (numCommande)"
        ]);
        /////////////////////////////////////////////////////////////
        
        ///////////////////////////////////////////////
        //              ENREG EN BASE                //
        ///////////////////////////////////////////////

        $order = new Order;
        //////////////////////////////////////////////
        ////////////////// SETS ORDER ////////////////
        //pour set setCreatedAt
        $today = new \DateTime();  // obligé de passer par un new Datetime car setCreatedAt attend un objet de type Date
        // Pour le setOrderNumber
        $currentUser = $this->getUser();
        dump($currentUser);
        $curentUserId = $currentUser->getId();
        $orderNumber = date('Y-m-d-H.m.s') .'-'. $curentUserId;
        //pour le setPaymentDate
        $paymentDate = $today;
        //setPaymentReference
        $paymentRef = $resultRequest['stripeToken'];   
        //setPaymentMethod
        $PaymentMethod = $paymentMethodService->getOne(2);//injection en dur, 1 seule methode de paiement pour l'instant
        //setUser
        $user = $userService->getOne($curentUserId);
        //setOrderStatus
        $orderStatus = $orderStatusService->getOne(5);// id "5" = "en attente de traitment"
        //setSentAt : pas à ce stade
        //setShippingCost : fait dans le calcul de montant total : $shippingCost
        //setTrackingNumber : pas à ce stade
        //setCarrier
        $carrier = $carrierService->getOne($idCarrier);//$idCarrier récupéré lors du calcul total panier
        
        //Sauvegarde des infos propres à la commande
        $orderService->saveOrder($order, $today, $orderNumber, $paymentDate, $paymentRef, $PaymentMethod, $user, $orderStatus, $carrier, $shippingCost);
        //$orderId = $order->getId();

        ///////////////////////////////////////////////
        ///////////// SETS ORDER-CONTENTS /////////////
        $cart = $session->get('cart');
        
        for($i=0; $i<count($cart['id']); $i++){

            $orderContent = new OrderContent;
            //setOrderRef
            //$orderRef = $orderService->getOne($orderId);// $orderId récupéré après le flush de l'order
            //setArticleRef
            $articleRef = $articleService->getOne($cart['id'][$i]);
            //set Quantity
            $articleQuantity = $cart['quantity'][$i];
            //setTaxe
            $tax = 1.2;
            //set setExclusiveOfTaxes
            $exclusiveOfTaxes = (($cart['price'][$i])/$tax);//TVA = 20%
            //setInclusiveOfTaxes
            $inclusiveOfTaxes = $cart['price'][$i]; // prix sur le site

            //incrémente orderContents et fait le setOrderRef,
            //utile dans le cas où on aurait besoin du getOrderContents
            //$order->addOrderContent($orderContent);

            //sauvegarde en base la ligne de commande
            $orderService->saveOrderContents($orderContent, $order, $articleRef, $articleQuantity, $tax, $exclusiveOfTaxes, $inclusiveOfTaxes);
                                                          //$order est déjà une instance de la cde, inutile de passer par $orderRef
        }
        
        ///////////////////////////////////////////////
        //Envoie des mails vers User & Seller
        $orderService->sendMails($orderNumber, $mailer);

        ///////////////////////////////////////////////
        //Vider le panier une fois les traitements finis
        $cartService->setEmptyCart($session);


        return $this->render('order/success.html.twig', [
            'orderNumber' => $orderNumber,

        ]);
    }
    
}








































        // DECLENCHEUR ?
       

           







