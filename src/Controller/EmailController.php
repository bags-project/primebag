<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmailController extends AbstractController
{
    /**
     * @Route("/email", name="email")
     */
    public function email($name, \Swift_Mailer $mailer)
    {
        $email = new Email();
        $form = $this->createForm(EmailType::class, $email);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
 
            $message = (new \Swift_Message('Bonjour Email'))
                ->setSubject('Email de Primebag')
                ->setFrom('primebag@gmail.com')
                ->setTo('furyfatal@laposte.net')
                ->setBody("Vous lisez mon email");

            $mailer->send($message);

            $email = $form->getData();

            return $this->render('email/index.html.twig', [
            ]);
        }

    }
}
