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


    //Envoie des mails vers User & Seller
    public function sendMails(){
        
        $message = (new \Swift_Message('Mail nouvelle preparation de commande'))
        ->setFrom('primebag62@gmail.com')
        ->setTo('primebag62@gmail.com')
        ->setBody(
            '<html>' .
            ' <body>' .
            ' <h1>Nouvelle commande</h1>'.
            // 'En date du'. $date.
            ' Une nouvelle commande numéro '. $order .
            ' </body>' .
            '</html>',
                'text/html' // Mark the content-type as HTML
            );

        $mailer->send($message);

        $message = (new \Swift_Message('Confirmation de nouvelle commande'))
        ->setFrom('primebag62@gmail.com')
        ->setTo('guillaume.goubel.pro@gmail.com')
        ->setBody(
            '<html>' .
            '<body>'.
            '<header>' .
                '<h1>FACTURE' .
                '<h2>Prime Bag − Vente de sacs </h2>' .
                '</h1>' .  //
            '</header>' .
            '<h2></h2>'.
            '<table>'.
            '<tr>'.
                '<td>Carmen</td>'.
                '<td>33 ans</td>'.
                '<td>Espagne</td>'.
            '</tr>'.
            '<tr>'.
                '<td>Michelle</td>'.
                '<td>26 ans</td>'.
                '<td>États-Unis</td>'.
            '</table>'.
                '</html>',  
                        'text/html' // Mark the content-type as HTML
            );

            $mailer->send($message);
    }

}