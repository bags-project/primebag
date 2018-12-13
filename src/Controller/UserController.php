<?php

namespace App\Controller;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use App\Entity\User;
use App\Form\UserRegisterType;
use App\Form\LoginType;
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
    * @Route("/user/login", name="user_login")
    */

    public function loginUser( Request $request, UserService $userService, AuthenticationUtils $authenticationUtils)
    {
        return $this->render('user/login.html.twig', [
            "lastUserName" =>  $authenticationUtils->getLastUsername(),

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

    /**
    * @Route("/user/profile{id}", name="user_profile", requirements={"id"="\d+"})
    * @IsGranted("ROLE_USER")
    */
    public function profilUser($id, Request $request , UserService $userService)
    {
        $user = new User ();

        $form = $this->createForm(UserRegisterType::Class, $user);

        $form->handleRequest($request);

        //$user = "nom";
        return $this->render('user/profile.html.twig',[
            "user" => $userService->getProfile($id),
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/logout", name ="logout")
     */

    public function logout()
    {
        
       return $this->render('main/index.html.twig');
    }

}
