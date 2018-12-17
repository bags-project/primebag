<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Service\ArticleService; 
use App\Service\BrandService;
use App\Service\ArticleColorService;  

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Brand;
use App\Entity\ArticleColor;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\RedirectResponse;

use App\Repository\EventRepository;
use App\Repository\CategoryRepository;
use App\Repository\BrandRepository;

use App\Form\FormType;
use Doctrine\Common\Persistence\ObjectManager;


class ArticleController extends AbstractController
{
    // https://roadtodev.com/fr/blog/symfony-4-reset-password
    
    /**
     * @Route("/", name="home")
     */
    public function listAll(ArticleService $articleService, Request $request)
     {


            return $this->render('main/index.html.twig', [
                'articles' => $articleService->showCase(),
            ]);
     }


    /**
     * @Route("/article/{id}", name="article_display", requirements={"id"="\d+"})
     */
    public function display(ArticleService $articleService, $id, Article $article)
    {
           $brandName = $article->getBrand()->getName();
           $colorName = $article->getArticleColor()->getName();
        //    $categoryName = $article->getcategories()[0]->getName();

           return $this->render('article/display.html.twig', [
           'article' => $articleService->getOne($id),
           'brandName' => $brandName,
        //    'categoryName' => $categoryName
           ]);
    }


    // /**
    //  * @Route("/article/gallerie/{category}", name="article_gallery")
    //  */
    // public function galleryList(ArticleService $articleService, Request $request)
    //  {      

    //         $path = $request->getPathInfo();

    //         return $this->render('article/gallery.html.twig', [
    //             'articles' => $articleService->getAll(),
    //             'path' => $path
    //         ]);
    //  }



    /**
     * @Route("/article/gallerie/femme", name="woman_gallery")
     */
    public function womanGallery(ArticleService $articleService, Request $request, BrandService $brandService , ArticleColorService $articleColorService  )
    {      
           
    $path = $request->getPathInfo();

    $queryCategories = $request->query->get('cat');
    $queryPrice = $request->query->get('price');

    return $this->render('article/gallery/woman.html.twig', [
        'articles' => $articleService->search($queryPrice), 
        'brands' => $brandService->getAllBrands(),
        'colors' => $articleColorService->getAllColors(),
        'cat' => $queryCategories ,
        'path' => $path
        ]);
    }


    /**
     * @Route("/article/gallerie/homme", name="man_gallery")
     */
    public function manGallery(ArticleService $articleService, Request $request, BrandService $brandService, ArticleColorService $articleColorService )
    {      
       $path = $request->getPathInfo();

       $queryCategories = $request->query->get('cat');
       $queryPrice = $request->query->get('price');
   
       return $this->render('article/gallery/man.html.twig', [
           'articles' => $articleService->search($queryPrice), 
           'brands' => $brandService->getAllBrands(),
           'colors' => $articleColorService->getAllColors(),
           'cat' => $queryCategories ,
           'path' => $path
           ]);
    }


    /**
     * @Route("/article/gallerie/scolaire", name="kid_gallery")
     */
    public function kidGallery(ArticleService $articleService, Request $request, BrandService $brandService , ArticleColorService $articleColorService )
    {      

       $path = $request->getPathInfo();

       $queryCategories = $request->query->get('cat');
       $queryPrice = $request->query->get('price');
   
       return $this->render('article/gallery/kid.html.twig', [
           'articles' => $articleService->search($queryPrice), 
           'brands' => $brandService->getAllBrands(),
           'colors' => $articleColorService->getAllColors(),
           'cat' => $queryCategories ,
           'path' => $path
           ]);
    }


    /**
     * @Route("/article/gallerie/bagage", name="bagage_gallery")
     */
    public function bagageGallery(ArticleService $articleService, Request $request, BrandService $brandService , ArticleColorService $articleColorService )
    {      

       $path = $request->getPathInfo();

       $queryCategories = $request->query->get('cat');
       $queryPrice = $request->query->get('price');
   
       return $this->render('article/gallery/bagage.html.twig', [
           'articles' => $articleService->search($queryPrice), 
           'brands' => $brandService->getAllBrands(),
           'colors' => $articleColorService->getAllColors(),
           'cat' => $queryCategories ,
           'path' => $path
           ]);
    }


}



