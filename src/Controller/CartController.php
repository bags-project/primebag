<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{

    // public function createCart(SessionInterface $session){
    // }

    /**
     * @Route("/cart", name="cart_content")
     */
    public function show(SessionInterface $session)
    {
        //$session->set('cart', []);
        //$cart = $session->get('cart');


        return $this->render('cart/view.html.twig', [
            'session' => $session->get(['cart'])
        ]);
    }


    /**
     * @Route("/cart/new", name="cart_add")
     */
    public function addToCart(Request $request, SessionInterface $session){
        // je verif si un panier existe, sinon j'en crée un vide
        // $currentSession = $session->get(['cart']);
        // if (!isset($currentSession)){
            // //if (null!==($session->get(['cart']))){
        // if (!isset($session['cart'])){
        //     $session->set(['cart'], []);
        //     $session->set(['cart']['articleId'], []);
        //     $session->set(['cart']['articleName'], []);
        //     $session->set(['cart']['articleRef'], []);
        //     $session->set(['cart']['articlePrice'], []);
        //     $session->set(['cart']['quantity'], []);
        //  }
        $session = $this->get('session');
        $session->set('cart', array(
            'articleId',
            'articleName',
            'articleRef',
            'articlePrice'
        ));


        //je récup en Get l'id de l'article sur lequel on a cliqué
        // $articleId = $request->query->get('article');
        // // on vérifie si l'id de l'article existe déjà dans le panier
        // $alreadyIn = array_search($articleId,  $session['cart']['articleId']);
        // if ($alreadyIn == true){
        //     // augmenter la quantité
        // }else{
            // je le set dans mon pannier
            //$cart = $session->get(['cart']);
            $session->set(['cart']['articleId'], $articleId); // est-ce que ça array-push automatiquement ?
        //}

        return $this->render('cart/view.html.twig', [
            'session' => $session->get(['cart'])
        ]);
    }

    /**
     * @Route("/cart/remove", name="cart_rem")
     */
    public function remFromCart(SessionInterface $session)
    {


        return $this->render('cart/index.html.twig', [
            'session' => $session
        ]);
    }


    /**
     * @Route("/cart/newvalidattion", name="cart_validate")
     */
    public function validateCart(SessionInterface $session)
    {


        return $this->render('cart/index.html.twig', [
            'session' => $session
        ]);
    }


    /**
     * @Route("/cart/reset", name="cart_reset")
     */
    public function emptyCart(SessionInterface $session)
    {


        return $this->render('cart/index.html.twig', [
            'session' => $session
        ]);
    }

}


