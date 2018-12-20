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

use App\Entity\Order;

use App\Entity\User;
use App\Form\UserRegisterType;
use App\Form\ResetPasswordType;
use App\Form\LoginType;
use App\Service\UserService;

use App\Repository\OrderRepository;
use App\Service\OrderService; 

use App\Repository\OrderContentRepository;
use App\Service\OrderContentService; 


class UserController extends AbstractController
{

    /**
    * @Route("/login", name="user_login")
    */

    public function loginUser( Request $request, AuthenticationUtils $authenticationUtils)
    {
        // En cas d'erreur d'autentification , l'utilisateur reçoit addFlash('danger')

            $this->addFlash(
                'danger',
                'Attention , il semble y avoir un souçi d\'authentification. Merci de vous logger avec vos bons identifiants'
            );

        // Si l'autentification réussi l'utilisateur est connecté et rediriger automatiquement vers la page d'accueil 

        return $this->render('user/login.html.twig');
    }

    /**
    * @Route("/register", name="user_register")
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
    public function profilUser(Request $request, OrderService $orderService, OrderContentService $orderContentService): Response
    {   

        return $this->render('user/profile.html.twig', [
            'user' => $this->getUser(),
            'orders' => $orderService->searchOrder(),
            'orderContents' => $orderContentService->searchOrderContents()
            ]);
    }

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
    * @Route("/user/delete/", name="user_delete")
    */
    public function delete(Request $request,  UserService $userService): Response
    {
        $user = $this->getUser();
        $userService->delete($user);

        $this->addFlash(
            'danger',
            'Utilisateur effacé !'
        );
        $this->get('security.token_storage')->setToken(null);
        return $this->redirectToRoute('logout');

        return $this->render('home', [
            'delete' => $this->getUser()
        ]);
    }

    /**
     * @Route("/forgotten_password", name="app_forgotten_password")
     */
    public function forgottenPassword(
        Request $request,
        UserPasswordEncoderInterface $encoder,
        \Swift_Mailer $mailer,
        TokenGeneratorInterface $tokenGenerator
    ): Response
    {

        // Envoie de mail pour les mots de passe oublié via un formulaire avec comme champ 'email'

        if ($request->isMethod('POST')) {

            $email = $request->request->get('email');


            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->findOneByEmail($email);

            // Si l'email est inconnu dans notre base de donné, alors un addFlash('danger') s'affiché

            if ($user === null) {
                $this->addFlash('danger', 'Email Inconnu');
                return $this->redirectToRoute('app_forgotten_password');
            }
            $token = $tokenGenerator->generateToken();

            try{

                // La varaible $token répresente "reset_token" dans notre base de donné. Si le champs n'est pas null, le champs est automatiquement vidé.

                $user->setResetToken($token);
                $entityManager->flush();
            } 
            
            // En cas d'erreur , alors un addFlash('warning') s'affiche

            catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('app_forgotten_password');
            }

            // Generation d'URL à laquelle on ajoute la variable $token. Cette variable se colle à la fin de l'url et 
            // s'ajoute dans la base de donné dans la table USER dans la ligne correspondant à l'email utilisateur saisi dans le formulaire.
            // Exemple d'URL avec le token http://127.0.0.1:8000/reset_password/k1CPkEtcgTzUm1l0XmngQd7TZXljlX-g9wlKSqwKgjQ

            $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);


            // Envoie de mail via Swift_Message

            $message = (new \Swift_Message('Mot de passe oublié?'))
                ->setFrom('primebag62@gmail.com')
                ->setTo($email)
                ->setBody(
                    "Voici le lien pour changer votre mot de passe : " . $url,
                    'text/html'
                );

            $mailer->send($message);

            // Si le mail est envoyé, un addFlash('mail') est affiché et l'utilisateur est redirectionné vers la page d'accueil

            $this->addFlash('success', 'Vous avez reçu un email à l\'adresse suivante : ' . $email);

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
 
            // Si le token est nul

            if ($user === null) {
                $this->addFlash('warning', 'Ce lien a déjà été utilisé ou est invalide');
                return $this->redirectToRoute('home');
            }
 
            $user->setResetToken(null);
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
            $entityManager->flush();
 
            $this->addFlash('success', 'Mot de passe mis à jour');
 
            return $this->redirectToRoute('home');
        }else {
 
            return $this->render('user/reset_password.html.twig', ['token' => $token]);
        }
 
    }

    /**
    * @Route("/logout", name ="logout")
    */

    public function logout()
    {
        
       return $this->render('main/index.html.twig');
    }

}


