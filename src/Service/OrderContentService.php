<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;

use App\Repository\OrderContentRepository;
use App\Entity\OrderContent;

class OrderContentService{

    private $om;

    public function __construct(ObjectManager $om, OrderContentRepository $repo){
        $this->om = $om;
    }

    public function searchOrderContents(){
        $repo = $this->om->getRepository(OrderContent::class);
        return $repo->searchOrderContents();
    }

}