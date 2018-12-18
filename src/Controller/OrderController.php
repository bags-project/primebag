<?php

namespace App\Controller;

use App\Entity\Order;
use App\Service\CartService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Email;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="order")
     */
    public function index(SessionInterface $session)
    {

    //     $date = new \DateTime();
    //     $session = $this->get('session');
    //     $carts = $session->get('cart');

    //     foreach ($carts as $key => $cart) {
            
    //         var_dump($cart->price);
    //     }

    //     return $this->render('order/order.html.twig', [
    //         'controller_name' => 'OrderController',
    //         'date'=> $date,
    //         'session' => $session,
    //         'cart' => $cart
    //     ]);
    }
    

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
    public function confirmValidatedOrder(SessionInterface $session, CartService $cartService, Request $request)
    {
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
                break;
            case 'chronopost':
                $totalCosts = ($totalCart + 10) * 100;
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


        $date = new \DateTime();

        //Ecrire les données dans la DB
        // + ajouter un champ stripeToken

        //Vider le panier une fois les traitements finis

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
           







