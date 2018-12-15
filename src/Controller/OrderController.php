<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="order")
     */
    public function index(SessionInterface $session)
    {

        $date = new \DateTime();

        $toto = $session->get('cart');


        return $this->render('order/order.html.twig', [
            'controller_name' => 'OrderController',
            'date'=> $date,
            'toto' => $toto
        ]);
    }
    
}
