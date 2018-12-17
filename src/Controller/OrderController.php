<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Service\CartService;

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


        return $this->render('order/buy.html.twig', [
            //'cart' => $cart,
            'date' => $date,
            'totalCart' => $totalCart

        ]);
    }

}
