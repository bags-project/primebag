<?php

namespace App\Controller;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

use App\Entity\User;
use App\Form\UserRegisterType;
use App\Form\LoginType;
use App\Service\UserService;
use App\Repository\UserRepository;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(UserRepository $userRepository): Response
    {
        
        return $this->render('user/index.html.twig',
        ['users' => $userRepository->findAll()]);
    }

    /**
    * @Route("/user/login", name="user_login", methods="POST")
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
            'user' => $user,
            "form" =>  $form->createView()
        ]);
    }

    /**
    * @Route("/user/profile{id}", name="user_profile", requirements={"id"="\d+"}, methods="GET")
    * 
    */
    public function profilUser(User $user, UserService $userService): Response
    {
    
    
        return $this->render('user/profile.html.twig', ['user' => $user]);
        
        
    }

    /**
     * @Route("user/{id}", name="user_show", methods="GET")
     * 
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', ['user' => $user]);
    }

    // /**
    //  * @Route("user/edit{id}", name="user_edit", methods="GET")
    //  */
    // public function edit(Request $request, User $user, UserService $userService, $id ): Response
    // {
    //     $form = $this->createForm(UserRegisterType::class, $user);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $userService->edit($id);
    //         //$this->getDoctrine()->getManager()->flush();

    //         return $this->redirectToRoute('user_index', ['id' => $user->getId()]);
    //     }

    //     return $this->render('user/edit.html.twig', [
    //         'user' => $user,
    //         'form' => $form->createView(),
    //     ]);
    // }

    /**
     * @Route("profile/edit{id}", name="user_edit", methods="GET|POST")
     * 
     */
    public function edit(Request $request, $id , UserService $userService , User $user): Response
    {
        $form = $this->createForm(UserRegisterType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userService->edit($id);

            return $this->redirectToRoute('user_edit', ['id' => $user->getId()]);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }


    /**
    * @Route("/{id}", name="user_delete", methods="DELETE")
    * 
    */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * @Route("/logout", name ="logout")
     */

    public function logout()
    {
        
       return $this->render('main/index.html.twig');
    }

}
