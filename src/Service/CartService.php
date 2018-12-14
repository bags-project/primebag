<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\ArticleRepository;

use App\Entity\Article;


class CartService 
{
    private $om;

    public function __construct( ObjectManager $om)
    {
        $this->om = $om;
        $this->encoder = $encoder;
    }


    public function addToCart(Request $request, SessionInterface $session){
        $session = $this->get('session');

        // je verif si un panier existe, sinon j'en crée un vide
        if($session->get('cart') == null){
            $session->set('cart', array('id' => [], 
                                        'name' => [],
                                        'ref' => [],
                                        'price' => [],
                                        'quantity' => [] ) );
        }

        $cart = $session->get('cart');

        //je récup en Get les infos de l'article ajouté au panier
        //$article = $request->query->get('articleId');
        $article = [
            'id' => $request->query->get('id'),
            'name' => $request->query->get('name'),
            'ref' => $request->query->get('ref'),
            'price' => $request->query->get('price'),
            //'quantity' => $request->query->get('articleQuantity'),
        ];

        // /!\ ajouter un choix de quantité sur la fiche article /!\ :
        //on vérifie si l'id de l'article existe déjà dans le panier
        $alreadyIn = array_search($article['id'],  $cart['id']);
        if ($alreadyIn == true){
            // augmenter la quantité
        }else{
            // je le Set dans mon pannier
            array_push($cart['id'], $article['id']);
            array_push($cart['name'], $article['name']);
            array_push($cart['ref'], $article['ref']);
            array_push($cart['price'], $article['price']);
            //array_push($cart['quantity'], $article['quantity']);
        }

        // je remet le panier actualisé dans la session
        $session->set('cart', $cart);

        return $this->render('cart/view.html.twig', [
            'session' => $session->get('cart')
        ]);
    }

}