<?php

namespace App\Service;

use App\Entity\Order;
use App\Entity\Carrier;

use App\Entity\OrderContent;
use App\Repository\OrderRepository;
use App\Entity\Order;

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

    
}
// Enreg Order
// Enreg contents
// exec. addOrderContent pr faire le lien ??