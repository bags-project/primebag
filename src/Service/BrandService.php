<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\BrandRepository;

use App\Entity\Brand;

class BrandService{

    private $om;

    public function __construct(ObjectManager $om, BrandRepository $repo){
        $this->om = $om;
    }

    public function getAllBrands(){
        $repo = $this->om->getRepository(Brand::class);
        return $repo->findAll();
    }

}

