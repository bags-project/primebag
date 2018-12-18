<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Service\CartService;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

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
    public function validOrder(SessionInterface $session, CartService $cartService)
    {
        //vérifier avant tout si l'utilisateur est connecté

        $date = new \DateTime();

        // calcul du total panier
        $totalCart = $cartService->calculateCartTotal($session);
















































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
           






        return $this->render('order/buy.html.twig', [
            //'cart' => $cart,
            'date' => $date,
            'totalCart' => $totalCart

        ]);
    }

}
