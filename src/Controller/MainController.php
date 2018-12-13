<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    // /**
    //  * @Route("/", name="home")
    //  */
    // public function index()
    // {
    //     $repo = $this->getDoctrine()->getRepository(Article::class); // Recup données dans BDD
    //     // $articles = $repo->findOneByTitle('Titre article'); // Pour trouver un article
    //     $articles = $repo->findAll(); // Pour trouver tous les articles
        
        
    //     return $this->render('main/index.html.twig', [
    //         'articles' => $articles
    //     ]);
    // }
}
