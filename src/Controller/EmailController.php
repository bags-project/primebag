<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmailController extends AbstractController
{
    // /**
    //  * @Route("/email", name="email")
    //  */
    // public function email($name, \Swift_Mailer $mailer)
    // {
    //     $email = new Email();
    //     $form = $this->createForm(EmailType::class, $email);

    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
 
    //         $message = (new \Swift_Message('Bonjour Email'))
    //             ->setSubject('Email de Primebag')
    //             ->setFrom('primebag@gmail.com')
    //             ->setTo('furyfatal@laposte.net')
    //             ->setBody("Vous lisez mon email");

    //         $mailer->send($message);

    //         $email = $form->getData();

    //         return $this->render('email/index.html.twig', [
    //         ]);
    //     }

    // }



    //PrimeBag62@gmail.com
    //Pass : Webforce3
    //https://stackoverflow.com/questions/39363613/swiftmailer-attachment-error-unable-to-open-file-for-reading-on-symfony2-proje


    /**
     * @Route("/email", name="email")
     */
    public function index(\Swift_Mailer $mailer)
    {

    $message = (new \Swift_Message('Hello Email'))
        ->setFrom('primebag62@gmail.com')
        ->setTo('primebag62@gmail.com')
        ->setBody('Here is the message itself')
        // ->attach(\Swift_Attachment::fromPath('my-document.pdf'))
        /*

         RENDU DE LA PAGE HTML

        ->setBody(
            $this->renderView(
                // templates/emails/registration.html.twig
                'emails/registration.html.twig',
                array('name' => $name)
            ),
            'text/html'
        
        
         * If you also want to include a plaintext version of the message
        ->addPart(
            $this->renderView(
                'emails/registration.txt.twig',
                array('name' => $name)
            ),
            'text/plain'
        )
        */
    ;

    $mailer->send($message);

    return $this->render('email/index.html.twig', [

    ]);

}
        











    



}
