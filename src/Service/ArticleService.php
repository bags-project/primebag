<?php

namespace App\Service;

use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\ArticleRepository;

use App\Entity\Article;

class ArticleService {

    private $om;

    public function __construct(ObjectManager $om, ArticleRepository $repo){
        $this->om = $om;
    }

    public function search($price) {
        $repo = $this->om->getRepository(Article::class); 
        return $repo->search($price);
    }

    public function searchAll() {
        $repo = $this->om->getRepository(Article::class); 
        return $repo->searchAll();
    }

    public function getOne($id) {
        $repo = $this->om->getRepository(Article::class); 
        return $repo->find($id);
    }

    public function getAll(){
        $repo = $this->om->getRepository(Article::class);
        return $repo->findAll();
    }

    public function showCase(){
        $repo = $this->om->getRepository(Article::class);
        return $repo->showCase();
    }





}
