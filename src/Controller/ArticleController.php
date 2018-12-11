<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\ArticleService; 

use App\Entity\Article;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\RedirectResponse;

use App\Repository\EventRepository;

use App\Form\FormType;
use Doctrine\Common\Persistence\ObjectManager;


class ArticleController extends AbstractController
{
    
    // /**
    //  * @Route("/article", name="article")
    //  */
    // public function index()
    // {
    //     return $this->render('article/index.html.twig', [
    //         'controller_name' => 'ArticleController',
    //     ]);
    // }



    // public function list(ArticleService $articleService, Request $request)
    //  {

    //     $page = $request->query->get('page');

    //     if(empty($page)){
    //         $page = 1; 
    //     }

    //         return $this->render('article/list.html.twig', [
    //             'events' => $articleService->search($page),
    //             /* 'events' => $eventService->getAll(),  */
    //             'date' => $date, 
    //             'page' => $page,
    //         ]);
    //  }



}


