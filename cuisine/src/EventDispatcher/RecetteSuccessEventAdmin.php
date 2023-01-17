<?php

namespace App\EventDispatcher;

use App\Event\RecetteSuccessEvent;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class RecetteSuccessEventAdmin implements EventSubscriberInterface
{
    protected $mailer;
    protected $security;

    public function __construct(MailerInterface $mailer, Security $security)
    {
        $this->mailer = $mailer;
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            'recette.success' => 'sendSuccessEmail'
        ];
    }

    public function sendSuccessEmail(RecetteSuccessEvent $recetteSuccessEvent)
    {
        /** @var User */
        $currentUser = $this->security->getUser();

        $recette = $recetteSuccessEvent->getRecette();

        $email = new TemplatedEmail();

        $email->to(new Address($currentUser->getEmail(), $currentUser->getUsername()))
            ->from("contact@mail.com")
            ->subject("Une nouvelle recette a été créée : ({$recette->getNom()}) !")
            ->htmlTemplate('emails/recette_success.html.twig')
            ->context([
                'recette' => $recette,
                'user' => $currentUser
            ]);

        $this->mailer->send($email);
    }
}
