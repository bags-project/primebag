<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmailController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(\Swift_Mailer $mailer, Request $request, ContactNotification $notification)
    {
        $email = new Contact();
        // $email->setContact($contact);
        $form = $this->createForm(ContactType::class, $email);

        $form->handleRequest($request);

        // var_dump($form);

        if ($form->isSubmitted() && $form->isValid()) {

            // $notification->notify($contact);

            $this->addFlash('success', 'Email envoyé !');
 
            $mail = (new \Swift_Message('Client Email'))
                ->setSubject('Message client')
                ->setFrom('client@gmail.com')
                ->setTo('primebag62@gmail.com')
                // ->setBody('Ceci est un test du texte du message client');
                ->setBody( $email->getMessage())
                ;

            $mailer->send($mail);


        }

        return $this->render('email/contact.html.twig', [
            // 'contact' => $contact,
            'form' => $form->createView()
            ]);

    }



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
            ->setBody('salut pepito')
            ->attach(\Swift_Attachment::fromPath('public/assets/pdf/1.pdf'))
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
