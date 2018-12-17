<?php
namespace App\Notification;

class ContactNotification {

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $renderer;

    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer = $mailer;
        $this->renderer = $renderer;
    }

    public function notify(Contact $contact) {
        $message = (new \Swift_Message('Client Email'))
            ->setSubject('Message client')
            ->setFrom('client@gmail.com')
            ->setTo('PrimeBag62@gmail.com')
            ->setBody("Vous lisez un message client");

        $mailer->send($message);

        $email = $form->getData();
    }
}