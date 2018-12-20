<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\PaymentMethodRepository;

use App\Entity\PaymentMethod;

class PaymentMethodService {

    private $om;

    public function __construct(ObjectManager $om){
        $this->om = $om;
    }

    public function getOne($id) {
        $repo = $this->om->getRepository(PaymentMethod::class); 
        return $repo->find($id);
    }

}
