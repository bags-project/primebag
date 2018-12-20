<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;
//use App\Entity\Order;
use App\Repository\OrderRepository;

class OrderService
{
    private $om;

    public function __construct(ObjectManager $om, ArticleRepository $repo){
        $this->om = $om;
    }

    // Enreg en base de la ligne de commande (OrderContent)
    public function saveOrderContents($orderContent, $articleRef, $articleQuantity, $tax, $exclusiveOfTaxes, $inclusiveOfTaxes){
        $repo = $this->om->getRepository(OrderContent::class);
        
        $orderContent->setArticleRef($articleRef);
        $orderContent->setQuantity($articleQuantity);
        $orderContent->setExclusiveOfTaxes($exclusiveOfTaxes);
        $orderContent->setInclusiveOfTaxes($inclusiveOfTaxes);
        $orderContent->setTaxe($tax);

        $this->om->persist( $orderContent );
        $this->om->flush();
    }


    // Enregistrement de la commande en DB
    public function saveOrder($order, $today, $orderNumber, $paymentDate, $paymentRef){
        $repo = $this->om->getRepository(Order::class);
        
        $order->setCreatedAt($today);
        $order->setOrderNumber($orderNumber);
        $order->setPaymentDate($paymentDate);
        $order->setPaymentReference($paymentRef);

        $this->om->persist( $order );
        $this->om->flush();
    }

}