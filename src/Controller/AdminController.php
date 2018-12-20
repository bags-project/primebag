<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Order;
use App\Entity\Article;
use App\Form\OrderType;
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
    * ===================== Affiche tous les articles sur une page pour admin ========================
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
            $article = new Article(); // new c'est que pour ajouter. Pour éditer, on récup grace au paramètre "Article $article" dans la fonction
        }   

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request); // Analyse la requete et recherche tous les champs du formulaire. Fait le lien entre les champs et l'entité Article

        // dump($article);

        if ($form->isSubmitted() and $form->isValid()) {

            $manager = $this->getDoctrine()->getManager();

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

            $this->addFlash(
                'notice',
                'Mission accomplie !'
            );

            $manager->persist($article);
            $manager->flush();

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
        $repo = $this->getDoctrine()->getRepository(User::class); // Select de l'entité User
        $users = $repo->findAll(); // Pour trouver tous les users

        return $this->render('admin/user.html.twig', [
            'users' => $users
        ]); // On donne la valeur $users à la variable users
    }


    /**
    * ===================== Effacer utilisateur ========================
    * @Route("/admin/user/del/{id}", name="admin_del_user")
    */
    public function delete_user(User $user, Request $request)
    {
        $emanager = $this->getDoctrine()->getManager();
        $emanager->remove($user);

        $emanager->flush();

        $this->addFlash(
            'notice',
            'Utilisateur effacé !'
        );
            
        return $this->redirectToRoute('admin_user');
    }





    /**
    * ===================== Affiche la liste des commandes pour admin ========================
    * @Route("/admin/order", name="admin_order")
    */
    public function admin_order()
    {
        $repo = $this->getDoctrine()->getRepository(Order::class); // Recup données dans BDD
        $orders = $repo->findAll(); // Pour trouver toutes les commandes

        return $this->render('admin/order.html.twig', [
            'orders' => $orders
        ]);
    }
    
    


    /**
    * ===================== Editer une commande ========================
    * @Route("/admin/{id}/order_edit", name="admin_order_edit")
    * @return Response
    */
    public function admin_order_edit(Order $order, Request $request)
    {
        // Grace à "Order $order", on récup les données d'Order

        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);

        // dump($order);

        if ($form->isSubmitted() and $form->isValid()) {

            $manager = $this->getDoctrine()->getManager();

            $manager->persist($order);
            $manager->flush();

            $this->addFlash(
                'notice',
                'Commande éditée !'
            );

            return $this->redirectToRoute('admin_order_edit', ['id' => $order->getId()]);

        }


        return $this->render('admin/order_edit.html.twig', [
            'form' => $form->createView()
        ]);
    }






    /**
    * ===================== Déconnecter admin ========================
    * @Route("/logout", name="logout")
    */
    public function logout() {
        return $this->render('main/index.html.twig');
    }
    
    


}
