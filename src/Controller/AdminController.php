<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
        return $this->render('admin/index.html.twig');
    }



    /**
    * @Route("/admin/article/", name="admin_article")
    */
    public function admin_article()
    {
        $repo = $this->getDoctrine()->getRepository(Article::class); // Recup données dans BDD
        // $articles = $repo->findOneByTitle('Titre article'); // Pour trouver un article
        $articles = $repo->findAll(); // Pour trouver tous les articles

        return $this->render('admin/index.html.twig', [
            'articles' => $articles
        ]);
    }


    /**
    * @Route("/admin/article_add/", name="admin_add")
    */
    public function admin_add(Article $article = null, Request $request)
    {
        $article = new Article();

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        // dump($article);

        if ($form->isSubmitted() and $form->isValid()) {
            // if (!$article->getId())
            // {
            //     $article->setCreatedAt(new \DateTime()); // Met automatiquement la date actuelle dans createdAt
            // }
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('admin_article', ['id' => $article->getId()]);

        }

        return $this->render('article/new.html.twig', [
        ]);
    }




}
