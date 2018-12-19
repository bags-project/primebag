<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function admin()
    {
        return $this->render('admin/login.html.twig', [
        ]);
    }


    /**
    * @Route("/admin/login", name="admin_login")
    */
    public function admin_login()
    {
        return $this->render('admin/login.html.twig', [
        ]);
    }


    /**
    * ===================== Affiche la liste des articles pour admin ========================
    * @Route("/admin/all/", name="admin_all")
    */
    public function admin_article_all()
    {
        $repo = $this->getDoctrine()->getRepository(Article::class); // Recup données dans BDD
        // $articles = $repo->findOneByTitle('Titre article'); // Pour trouver un article
        $articles = $repo->findAll(); // Pour trouver tous les articles

        return $this->render('admin/all.html.twig', [
            'articles' => $articles
        ]);
    }




    /**
    * ===================== Affiche la liste des articles avec pagination ========================
    * @Route("/admin/page/{page<\d+>?1}", name="admin_article")
    * // Regex : d pour nombre, + pour un ou plusieurs, ? pour optionnel, 1 pour valeur par défaut
    */
    public function admin_page($page = 1)
    {
        $repo = $this->getDoctrine()->getRepository(Article::class); // Recup données dans BDD
    
        $limit = 10;
        $start = $page * $limit - $limit;
        // 1*10 - 10 = 0
        // 2*10 - 10 = 10
        $total = count($repo->findAll());
        $pages = ceil($total / $limit); // ceil arrondit au nb supérieur

        return $this->render('admin/index.html.twig', [
            'articles' => $repo->findBy([], [], $limit, $start),
            'pages' => $pages,
            'page' => $page

        ]);
    }


    /**
    * ===================== Affiche 20 premiers articles ========================
    * @Route("/admin/page1/", name="admin_page1")
    */
    public function admin_p1()
    {
        $repo = $this->getDoctrine()->getRepository(Article::class); // Recup données dans BDD
        $articles = $repo->findBy([], [], 20, 0); // Sans critère de recherche, ordre par défaut, par 20 articles, à partir de l'index 0

        return $this->render('admin/all.html.twig', [
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

            // Upload poster :
            if(!empty($article->getPosterUrl() )) {
                $article->setPoster( $article->getPosterUrl() );
            }
            else
            {
                $file = $article->getPosterFile();
                $filename = md5( uniqid() ).'.'.$file->guessExtension();
        
                $file->move( './assets/img/poster/', $filename );
        
                $article->setPoster( $filename );
            }
            $manager->persist($article);
            $manager->flush();


            // if(!empty($article->getAltPicture1Url() )) {
            //     $article->setAltPicture1( $article->getAltPicture1Url() );
            // }
            // else
            // {
            //     $file1 = $article->getAltPicture1File();
            //     $filename1 = md5( uniqid() ).'.'.$file1->guessExtension();
        
            //     $file1->move( './assets/img/poster/', $filename1 );
        
            //     $article->setAltPicture1( $filename1 );
            // }
            // $manager->persist($article);
            // $manager->flush();




            return $this->redirectToRoute('admin_all', ['id' => $article->getId()]);

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
    // methods="DELETE"
    public function delete(Article $article, Request $request)
    {
        // if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token')))
        // {
            $em = $this->getDoctrine()->getManager();
            $em->remove($article);
            $em->flush();

            $this->addFlash(
                'notice',
                'Article effacé !'
            );

        // }

        return $this->redirectToRoute('admin_all');
    }

    /**
    * ===================== Affiche la liste des utilisateurs ========================
    * @Route("/admin/user/", name="admin_user")
    */
    public function admin_user()
    {
        $repo = $this->getDoctrine()->getRepository(User::class); // Recup données dans BDD
        $users = $repo->findAll(); // Pour trouver tous les users

        return $this->render('admin/user.html.twig', [
            'users' => $users
        ]);
    }

    /**
    * ===================== Effacer utilisateur ========================
    * @Route("/admin/user/del/{id}", name="admin_del_user")
    */
    public function delete_user(User $user, Request $request)
    {
        // if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token')))
        // {
            $emanager = $this->getDoctrine()->getManager();
            $emanager->remove($user);

            $emanager->flush();

            $this->addFlash(
                'notice',
                'Utilisateur effacé !'
            );
            
        // }

        return $this->redirectToRoute('admin_user');
    }



    /**
     * ===================== Déconnecter admin ========================
     * @Route("/logout", name="logout")
     */
     public function logout() {
        return $this->render('main/index.html.twig');
     }

    
    
    
    
    
    /**
    * ===================== Suivre les commandes client ========================
    * @Route("/admin/order", name="admin_order")
    */
    public function admin_order()
    {

        return $this->render('admin/order.html.twig', [
        ]);
    }





}
