<?php

namespace App\Controller;

use App\Service\CartService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{

    /**
     * @Route("/cart", name="cart_view")
     */
    public function show(SessionInterface $session, CartService $cartService)
    {
        // je verif si un panier existe, sinon j'en crée un vide
        if($session->get('cart') == null){
            $cartService->setEmptyCart($session);
        }
          
        $totalCart = $cartService->calculateCartTotal($session);

        return $this->render('cart/view.html.twig', [
            'totalCart' => $totalCart
        ]);
    }



    /**
     * @Route("/cart/add", name="cart_add")
     */
    public function addToCart(Request $request, SessionInterface $session, CartService $cartService){
        $session = $this->get('session');

        if($session->get('cart') == null){
            $cartService->setEmptyCart($session);
        }

        $cart = $session->get('cart');

        //je récup en Get les infos de l'article ajouté au panier
        $article = [
            'id' => $request->query->get('id'),
            'name' => $request->query->get('name'),
            'ref' => $request->query->get('ref'),
            'price' => $request->query->get('price'),
            'poster' => $request->query->get('poster'),
            'quantity' => $request->query->get('quantity'),
        ];

        // //on vérifie si l'id de l'article existe déjà dans le panier
        // $alreadyIn = array_search($article['id'],  $cart['id']);
        // if ($alreadyIn == true){
        //     // Si c'est le cas, MàJ de la quantité
        //     $nbArticlesInCart = count($cart['id']);
        //     for($i=0; $i<$nbArticlesInCart; $i++){
        //         if($cart['id'] == $article['id']){
        //             $article['quantity'] += $cart['quantity'];
        //             $cart['quantity'] = $article['quantity'];
        //         }
        //     }  
        // }else{

            // je le Set dans mon pannier
            array_push($cart['id'], $article['id']);
            array_push($cart['name'], $article['name']);
            array_push($cart['ref'], $article['ref']);
            array_push($cart['price'], $article['price']);
            array_push($cart['poster'], $article['poster']);
            array_push($cart['quantity'], $article['quantity']);

        // }

        // je remet le panier actualisé dans la session
        $session->set('cart', $cart);

        return $this->render('cart/add.html.twig', [
            'articleName' => $article['name'],
            'articlePrice' => $article['price'],
            'articlePoster' => $article['poster']      
        ]);
    }



    /**
     * @Route("/cart/remove", name="cart_remove")
     */
    public function remFromCart(Request $request, SessionInterface $session)
    {
        $session = $this->get('session');
        $cart = $session->get('cart');

        //recherche de l'index correspondant à l'id reçu en Get
        $receivedId = $request->query->get('id');
        $key = array_search($receivedId, $cart['id']);

        // je récup le nom avant suppression pour l'afficher sur la page de confirmation
        $itemToDelete = $cart['name'][$key];

        //suppr de l'article du panier
        unset($cart['id'][$key]);
        $cart['id'] = array_values($cart['id']); //je réinitialise les index des tableaux pour éviter les trous de clé. Sinon less for($i...) ne passeront plus
        unset($cart['name'][$key]);
        $cart['name'] = array_values($cart['name']);
        unset($cart['ref'][$key]);
        $cart['ref'] = array_values($cart['ref']);
        unset($cart['price'][$key]);
        $cart['price'] = array_values($cart['price']);
        unset($cart['poster'][$key]);
        $cart['poster'] = array_values($cart['poster']);
        unset($cart['quantity'][$key]);
        $cart['quantity'] = array_values($cart['quantity']);

        $session->set('cart', $cart);

        return $this->render('cart/remove.html.twig',[
            'articleName' => $itemToDelete
        ]);
    }


    
    /**
     * @Route("/cart/reset", name="cart_reset")
     */
    public function emptyCart(SessionInterface $session, CartService $cartService){
        $session = $this->get('session');
        $cart = $session->get('cart');

        $cartService->setEmptyCart($session);

        return $this->render('cart/view.html.twig', [
            'session' => $session
        ]);
    }



    /**
     * @Route("/cart/validation", name="cart_validate")
     */
    public function validateCart(SessionInterface $session)
    {

        return $this->render('cart/index.html.twig', [
            'session' => $session
        ]);
    }



    // /**
    //  * Route de confirmation de suppression pour que le modal récupère l'id
    //  * @Route("/cart/{id}", name="cart_rem_confirm", requirements={"id"="\d+"})
    //  */
    // public function confirmModalRemFromCart(Request $request, $id, SessionInterface $session)
    // {
    //     $session = $this->get('session');
    //     $cart = $session->get('cart');

    //     //recup de l'id reçu en Get
    //     $receivedId = $request->query->get('id');

    //     return $this->render('cart/view.html.twig',[
    //         'id' => $receivedId
    //     ]);
    // }
}


