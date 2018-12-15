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

    public function setEmptyCart(SessionInterface $session) {

        $session->get('session');

        $session->set('cart', array('id' => [], 
                                    'name' => [],
                                    'ref' => [],
                                    'price' => [],
                                    'poster' => [],
                                    'quantity' => [] ) 
        );
        //$cart = $session->get('cart');     
    }


}