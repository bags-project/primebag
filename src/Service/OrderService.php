<?php

namespace App\Service;

use App\Entity\Carrier;

use App\Entity\OrderContent;
use App\Repository\OrderRepository;

use App\Repository\OrderContentRepository;
use Doctrine\Common\Persistence\ObjectManager;

class OrderService
{
    private $om;

    public function __construct(ObjectManager $om){
        $this->om = $om;
    }

    //Récupérer une commande
    public function getOne($id) {
        $repo = $this->om->getRepository(Order::class); 
        return $repo->find($id);
    }

    //////////////////////////////////////////////////////////
    // Enregistrement de la commande en DB
    public function saveOrder($order, $today, $orderNumber, 
                        $paymentDate, $paymentRef, $PaymentMethod, 
                        $user, $orderStatus, $carrier, $shippingCost){
        //$repo = $this->om->getRepository(Order::class);
        
        $order->setCreatedAt($today);
        $order->setOrderNumber($orderNumber);
        $order->setPaymentDate($paymentDate);
        $order->setPaymentReference($paymentRef);
        $order->setPaymentMethod($PaymentMethod);
        $order->setUser($user);
        $order->setOrderStatus($orderStatus);
        $order->setShippingCost($shippingCost);
        $order->setCarrier($carrier);

        $this->om->persist( $order );
        $this->om->flush();

        // $orderId = $order->getId();
        // return $orderId;
    }

    //////////////////////////////////////////////////////////
    // Enreg en base de la ligne de commande (OrderContent)
    public function saveOrderContents($orderContent, $orderRef, $articleRef, $articleQuantity, $tax, $exclusiveOfTaxes, $inclusiveOfTaxes){
        //$repo = $this->om->getRepository(OrderContent::class);
        
        $orderContent->setOrderRef($orderRef);
        $orderContent->setArticleRef($articleRef);
        //$orderContent->setArticleRef($articleService->getOne($articleRef));
        $orderContent->setQuantity($articleQuantity);
        $orderContent->setExclusiveOfTaxes($exclusiveOfTaxes);
        $orderContent->setInclusiveOfTaxes($inclusiveOfTaxes);
        $orderContent->setTaxe($tax);

        $this->om->persist( $orderContent );
        $this->om->flush();
    }

    
    public function searchOrder(){
        $repo = $this->om->getRepository(Order::class);
        return $repo->searchOrder();
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
    public function sendMails($orderNumber, $currentUser){
        //$currentUser : tableau avec toutes les infos du user (firstName...)
    $message = (new \Swift_Message('Mail nouvelle preparation de commande'))
    ->setFrom('primebag62@gmail.com')
    ->setTo('primebag62@gmail.com')
    ->setBody(
        '<html>' .
        ' <body>' .
        ' <h1>Nouvelle commande</h1>'.
        // 'En date du'. $date.
        ' Une nouvelle commande numéro '. $orderNumber . 'a été créée.'
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
