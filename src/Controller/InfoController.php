<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InfoController extends AbstractController
{
    /**
     * @Route("/info", name="cgv")
     */
    public function cgv()
    {
        return $this->render('info/cgv.html.twig', [
        ]);
    }


    /**
     * @Route("/faq", name="faq")
     */
    public function faq()
    {
        return $this->render('info/faq.html.twig', [
        ]);
    }


     /**
     * @Route("/our", name="our")
     */
     public function our()
     {
         return $this->render('info/our.html.twig', [
         ]);
     }
 


}
