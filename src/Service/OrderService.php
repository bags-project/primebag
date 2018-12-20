<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;

use App\Repository\OrderRepository;
use App\Entity\Order;




class OrderService{

    private $om;

    public function __construct(ObjectManager $om, OrderRepository $repo){
        $this->om = $om;
    }

    public function searchOrder(){
        $repo = $this->om->getRepository(Order::class);
        return $repo->searchOrder();
    }  

}