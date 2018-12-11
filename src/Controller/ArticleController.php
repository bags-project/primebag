<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function articles()
    {
        $repo = $this->getDoctrine()->getRepository(Article::class); // Recup données dans BDD
        // $articles = $repo->findOneByTitle('Titre article'); // Pour trouver un article
        $articles = $repo->findAll(); // Pour trouver tous les articles
        
        return $this->render('article/index.html.twig', [
        ]);
    }




}
