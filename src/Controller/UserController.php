<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\User;
use App\Form\UserRegisterType;
use App\Service\UserService;


class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
    * @Route("/user/register", name="user_register")
    */

    public function registerUser( Request $request, UserService $userService)
    {
        $user = new User();
        $form = $this->createForm(UserRegisterType::Class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {

            $userService->registerUser( $user );

            return $this->redirectToRoute('home');
        }

        return $this->render('user/registerUser.html.twig', [
            "form" =>  $form->createView()
        ]);
    }
}
