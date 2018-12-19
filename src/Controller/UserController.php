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
    //private $user;


    /**
    * @Route("/user/login", name="user_login")
    */

    public function loginUser( Request $request, AuthenticationUtils $authenticationUtils)
    {

            $this->addFlash(
                'danger',
                'Il y a une erreur de saisir dans votre identifiant ou votre mot de passe.'
            );


        return $this->render('user/login.html.twig');
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

            $this->addFlash(
                'notice',
                'Votre compte a été ajouté avec succès! 
                 Vous pouvez dès maintenant vous connecter à votre compte.'
            );

            return $this->redirectToRoute('home');

        }

        return $this->render('user/registerUser.html.twig', [
            'user' => $user,
            "form" =>  $form->createView()
        ]);
    }

    /**
    * @Route("/user/profile", name="user_profile")
    * 
    */
    public function profilUser(UserService $userService): Response
    {
    
    
        return $this->render('user/profile.html.twig');
        
        
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
     * @Route("user/profile/edit", name="user_edit")
     * 
     */
    public function edit(Request $request, UserService $userService): Response
    {
        $form = $this->createForm(UserRegisterType::class, $this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userService->edit();

            return $this->redirectToRoute('user_edit');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $this->getUser(),
            'form' => $form->createView(),
        ]);
    }


    /**
    * @Route("/user/delete/{id}", name="user_delete")
    */
    public function delete(Request $request, User $user): Response
    {


        $em = $this->getDoctrine()->getManager();
        $em->remove($user);

        $em->flush();

        $this->addFlash(
            'notice',
            'Utilisateur effacé !'
        );

        // if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
        //     $em = $this->getDoctrine()->getManager();
        //     $em->remove($user);
        //     $em->flush();
        // }

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
     * @Route("user/forgotten_password", name="app_forgotten_password")
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
                return $this->redirectToRoute('app_forgotten_password');
            }
            $token = $tokenGenerator->generateToken();

            try{
                $user->setResetToken($token);
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('app_forgotten_password');
            }

            $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);


            $message = (new \Swift_Message('Forgot Password'))
                ->setFrom('primebag62@gmail.com')
                ->setTo($email)
                ->setBody(
                    "Voici le lien pour changer votre mot de passe : " . $url,
                    'text/html'
                );

            $mailer->send($message);

            //var_dump($email);


            

            //$this->addFlash('token', $url);


            $this->addFlash('notice', 'Vous avez réussi un email à l\'adresse suivante : ' . $email);

            //var_dump($message);

            return $this->redirectToRoute('home');
        }

        $url = null;

        return $this->render('user/forgotten_password.html.twig');
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


