<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\ArticleRepository;

use App\Entity\Article;

class ArticleService {

    private $om;

    public function __construct(ObjectManager $om, ArticleRepository $repo ){
        $this->om = $om;
    }

    public function getAll(){
        $repo = $this->om->getRepository(Article::class);
        return $this->repo->findAll();
    }

    



}