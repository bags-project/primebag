<?php

namespace App\Controller;

use App\Entity\User;
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
        $repo = $this->getDoctrine()->getRepository(Article::class); // Recup données dans BDD
        // $articles = $repo->findOneByTitle('Titre article'); // Pour trouver un article
        $articles = $repo->findAll(); // Pour trouver tous les articles

        return $this->render('admin/index.html.twig', [
            'articles' => $articles
        ]);
    }



    /**
    * ===================== Affiche la liste des articles pour admin ========================
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
    * ===================== Ajouter ou éditer article ========================
    * @Route("/admin/add/", name="admin_add")
    * @Route("/admin/{id}/edit", name="admin_edit")
    */
    public function admin_add(Article $article = null, Request $request)
    {
        if (!$article)
        {
            $article = new Article();
        }   

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        // dump($article);

        if ($form->isSubmitted() and $form->isValid()) {

            $manager = $this->getDoctrine()->getManager();

            // $owner = $manager->find( User::class, '1');
            // $article->setOwner($owner);

            // Upload
            if(!empty($article->getPosterUrl() )) {
                $article->setPoster( $article->getPosterUrl() );
            }
            else
            {
                $file = $article->getPosterFile();
                $filename = md5( uniqid() ).'.'.$file->guessExtension();
        
                $file->move( './assets/img', $filename );
        
                $article->setPoster( $filename );
            }

            $manager->persist($article);
            $manager->flush();

            return $this->redirectToRoute('admin_article', ['id' => $article->getId()]);

        }

        return $this->render('admin/create.html.twig', [
            'form' => $form->createView(),
            'editMode' =>$article->getId() !== null
        ]);
    }






    /**
    * ===================== Effacer article ========================
    * @Route("/admin/{id}/del", name="admin_del")
    */
    public function delete(Article $article, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();
        }

        return $this->redirectToRoute('admin_article');
    }




}
