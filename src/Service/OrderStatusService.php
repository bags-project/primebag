<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\OrderStatusRepository;

use App\Entity\OrderStatus;

class OrderStatusService {

    private $om;

    public function __construct(ObjectManager $om){
        $this->om = $om;
    }

    public function getOne($id) {
        $repo = $this->om->getRepository(OrderStatus::class); 
        return $repo->find($id);
    }

}
