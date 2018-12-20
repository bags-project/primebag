<?php

namespace App\Service;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class CartService {

    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

   // Initialisation du panier
    public function setEmptyCart(SessionInterface $session) {

        $session->get('session');

        $session->set('cart', array('id' => [], 
                                    'name' => [],
                                    'ref' => [],
                                    'price' => [],
                                    'poster' => [],
                                    'quantity' => [] ) 
        );    
    }

    // Calcul du total du panier
    public function calculateCartTotal(SessionInterface $session){
        $cart = $session->get('cart');
        $totalCart = 0;

        for ($i=0; $i<count($cart['id']); $i++){
            $totalCart += $cart['price'][$i] * $cart['quantity'][$i];
        }
        return $totalCart;
    }


}