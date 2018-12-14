<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\ArticleColorRepository;

use App\Entity\ArticleColor;

class ArticleColorService{

    private $om;

    public function __construct(ObjectManager $om, ArticleColorRepository $repo){
        $this->om = $om;
    }

    public function getAllColors(){
        $repo = $this->om->getRepository(ArticleColor::class);
        return $repo->findAll();
    }

}

