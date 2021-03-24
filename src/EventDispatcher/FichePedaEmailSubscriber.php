<?php


namespace App\EventDispatcher;


use App\Event\FicheCreateEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;

class FichePedaEmailSubscriber implements EventSubscriberInterface
{

    protected $logger;
    protected $mailer;

    public function __construct(LoggerInterface $logger , MailerInterface $mailer)
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
    }



    public function sendEmail (FicheCreateEvent $ficheCreateEvent)
    {
        $email = new Email();
        $email->from(new Address("contact@mail.com" , "FichePeda Robot"))
            ->to("user@gmail.com")
            ->text("Un utilisateur a créer une fiche pedagogique°" .
                $ficheCreateEvent->getFichePeda()->getId())
            ->subject("Creation de la fiche n°" . $ficheCreateEvent->getFichePeda()->getId());

        $this->mailer->send($email);
        $this->logger->info("Email envoyé à l'admin pour la fiche");
        $ficheCreateEvent->getFichePeda()->getId();
    }

    public static function getSubscribedEvents()
    {
        return [
            'fiche_create' => 'sendEmail'
        ];
    }
}