<?php

namespace App\Controller;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;



use App\Entity\User;
use App\Form\UserRegisterType;
use App\Form\ResetPasswordType;
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
    */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('home', [
            'delete' => $user
        ]);
    }

    // /**
    //  * @Route("/forgottenPassword", name="app_forgotten_password")
    //  */
    // public function forgottenPassword(): Response
    // {
 
    //     return $this->render('user/forgotten_password.html.twig');
    // }

        /**
     * @Route("user /forgotten_password", name="app_forgotten_password")
     */
    public function forgottenPassword(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        \Swift_Mailer $mailer,
        TokenGeneratorInterface $tokenGenerator
    ): Response
    {

        if ($request->isMethod('POST')) {

            $email = $request->request->get('email');

            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->findOneByEmail($email);
            /* @var $user User */


            if ($user === null) {
                $this->addFlash('danger', 'Email Inconnu');
                return $this->redirectToRoute('home');
            }
            $token = $tokenGenerator->generateToken();

            try{
                $user->setResetToken($token);
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('home');
            }

            $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);

            $message = (new \Swift_Message('Forgot Password'))
                ->setFrom('primebag62@gmail.com')
                ->setTo($email)
                ->setBody(
                    "blablabla voici le token pour reseter votre mot de passe : " . $url,
                    'text/html'
                );

                var_dump($email);
                var_dump($message->setTo($email));
            

            $mailer->send($message);

            $this->addFlash('token', $url);


            $this->addFlash('notice', 'Mail envoyé');

            //var_dump($message);

            //return $this->redirectToRoute('home');
        }

        return $this->render('user/forgotten_password.html.twig',[
            'token' => $url
        ]);
    }

    /**
    * @Route("/reset_password/{token}", name="app_reset_password")
    */
    public function resetPassword(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder)
    {
 
        if ($request->isMethod('POST')) {
            $entityManager = $this->getDoctrine()->getManager();
 
            $user = $entityManager->getRepository(User::class)->findOneByResetToken($token);
            /* @var $user User */
 
            if ($user === null) {
                $this->addFlash('danger', 'Token Inconnu');
                return $this->redirectToRoute('homepage');
            }
 
            $user->setResetToken(null);
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
            $entityManager->flush();
 
            $this->addFlash('notice', 'Mot de passe mis à jour');
 
            return $this->redirectToRoute('home');
        }else {
 
            return $this->render('user/reset_password.html.twig', ['token' => $token]);
        }
 
    }

    

    // /**
    //  * @Route("/passwordEdite", name="password_edite",)
    //  * 
    //  */

    // public function editAction(Request $request)
    // {
    // 	$em = $this->getDoctrine()->getManager();
    //     $user = $this->getUser();
    // 	$form = $this->createForm(ResetPasswordType::class, $user);

    // 	$form->handleRequest($request);
    //     if ($form->isSubmitted() && $form->isValid()) {

    //         $passwordEncoder = $this->get('security.password_encoder');
    //         $oldPassword = $request->request->get('etiquettebundle_user')['oldPassword'];

    //         // Si l'ancien mot de passe est bon
    //         if ($passwordEncoder->isPasswordValid($user, $oldPassword)) {
    //             $newEncodedPassword = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
    //             $user->setPassword($newEncodedPassword);
                
    //             $em->persist($user);
    //             $em->flush();

    //             $this->addFlash('notice', 'Votre mot de passe à bien été changé !');

    //             return $this->redirectToRoute('profile');
    //         } else {
    //             $form->addError(new FormError('Ancien mot de passe incorrect'));
    //         }
    //     }
    	
    // 	return $this->render('user/password.html.twig', array(
    // 		'form' => $form->createView(),
    // 	));
    // }


    /**
     * @Route("/logout", name ="logout")
     */

    public function logout()
    {
        
       return $this->render('main/index.html.twig');
    }

}


