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




}
