<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\CarrierRepository;

use App\Entity\Carrier;

class CarrierService {

    private $om;

    public function __construct(ObjectManager $om){
        $this->om = $om;
    }

    public function getOne($id) {
        $repo = $this->om->getRepository(Carrier::class); 
        return $repo->find($id);
    }

}
