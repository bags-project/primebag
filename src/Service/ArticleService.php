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

    public function showCase(){
        $repo = $this->om->getRepository(Article::class);
        return $repo->showCase();
    }

    public function getOne($id) {
        $repo = $this->om->getRepository(Article::class); 
        return $repo->find($id);
    }

    public function search($price, $page) {
        $repo = $this->om->getRepository(Article::class); 
        return $repo->search($price, $page);
    }

    public function searchAll() {
        $repo = $this->om->getRepository(Article::class); 
        return $repo->searchAll();
    }

    public function getAll(){
        $repo = $this->om->getRepository(Article::class);
        return $repo->findAll();
    }







}
