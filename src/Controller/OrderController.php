<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderContent;
use App\Service\CartService;
use App\Service\OrderService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Email;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\Date;

class OrderController extends AbstractController
{
    private $orders;

    /**
     * @Route("/buy", name="order_valid")
     */
    public function validOrder(SessionInterface $session, CartService $cartService, Request $request)
    {
        //vérifier avant tout si l'utilisateur est connecté

        $date = new \DateTime();

        // calcul du total panier
        $totalCart = $cartService->calculateCartTotal($session);

        return $this->render('order/buy.html.twig', [
            'date' => $date,
            'totalCart' => $totalCart

        ]);
    }



    /**
     * @Route("/buy/success", name="order_success")
     */
    public function confirmValidatedOrder(SessionInterface $session, CartService $cartService, OrderService $orderService, Request $request)
    {

        //////////////////////////////////////////////////

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
                $totalCosts = ($totalCart + 5) * 100; // *100 car unité par défaut en centimes
                //pour pouvoir afficher la fouchette du délai de livraison
                $in1days = date('Y-m-d H:m:s', strtotime('+1 day'));
                $in8days = date('Y-m-d H:m:s', strtotime('+8 day'));
                break;
            case 'chronopost':
                $totalCosts = ($totalCart + 10) * 100;
                $in1days = date('Y-m-d H:m:s', strtotime('+1 day'));
                $in3days = date('Y-m-d H:m:s', strtotime('+3 day'));
                break;
            case 'retraitMag':
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
        

        $order = new Order;
        ///////////// SETS ORDER-CONTENTS /////////////
        $cart = $session->get('cart');
        
        for($i=0; $i<count($cart['id']); $i++){

            $orderContent = new OrderContent;
            //setArticleRef
            $articleRef = $cart['ref'][$i];
            //set Quantity
            $articleQuantity = $cart['quantity'][$i];
            //setTaxe
            $tax = 1.2;
            //set setExclusiveOfTaxes
            $exclusiveOfTaxes = (($cart['price'][$i])/$tax);//TVA = 20%
            //setInclusiveOfTaxes
            $inclusiveOfTaxes = $cart['price'][$i]; // prix sur le site

            //incrémente orderContents et fait le setOrderRef
            $order->addOrderContent($orderContent);

            //sauvegarde en base la ligne de commande
            $orderService->saveOrderContents($orderContent, $articleRef, $articleQuantity, $tax, $exclusiveOfTaxes, $inclusiveOfTaxes);
            
        }

        
        ////////////////// SETS ORDER ////////////////
        //pour set setCreatedAt
        $today = date("Y-m-d H:m:s");  // remplacer par un new Datetime ?
        // Pour le setOrderNumber
        $currentUser = $this->getUser();
        $curentUserId = $currentUser->getId();
        $orderNumber = $today .'-'. $curentUserId;
        //pour le setPaymentDate
        $paymentDate = $today;
        //setPaymentReference
        $paymentRef = $resultRequest['stripeToken'];
        
        ///////////////////////////////
        //Sauvegarde des infos propres à la commande

        $orderService->saveOrder($order, $today, $orderNumber, $paymentDate, $paymentRef);
        





        //Envoie des mails vers User & Seller


        //Vider le panier une fois les traitements finis
        //$cartService->setEmptyCart($session);

        return $this->render('order/success.html.twig', [
            'date' => $date,
            'totalCosts' => $totalCosts,

        ]);
    }





    
}








































        // DECLENCHEUR ?
       
            //    $message = (new \Swift_Message('Mail nouvelle preparation de commande'))
            //    ->setFrom('primebag62@gmail.com')
            //    ->setTo('primebag62@gmail.com')
            //    ->setBody(
            //        '<html>' .
            //        ' <body>' .
            //        ' <h1>Nouvelle commande</h1>'.
            //        // 'En date du'. $date.
            //        ' Une nouvelle commande numéro '. $order .
            //        ' </body>' .
            //        '</html>',
            //          'text/html' // Mark the content-type as HTML
            //        );
       
            //    $mailer->send($message);
       
            //    $message = (new \Swift_Message('Confirmation de nouvelle commande'))
            //    ->setFrom('primebag62@gmail.com')
            //    ->setTo('guillaume.goubel.pro@gmail.com')
            //    ->setBody(
            //        '<html>' .
            //        '<body>'.
            //        '<header>' .
            //          '<h1>FACTURE' .
            //            '<h2>Prime Bag − Vente de sacs </h2>' .
            //          '</h1>' .  //
            //        '</header>' .
            //        '<h2></h2>'.
            //        '<table>'.
            //        '<tr>'.
            //            '<td>Carmen</td>'.
            //            '<td>33 ans</td>'.
            //            '<td>Espagne</td>'.
            //        '</tr>'.
            //        '<tr>'.
            //            '<td>Michelle</td>'.
            //            '<td>26 ans</td>'.
            //            '<td>États-Unis</td>'.
            //        '</table>'.
            //            '</html>',  
            //                    'text/html' // Mark the content-type as HTML
            //        );
       
            //        $mailer->send($message);
           







