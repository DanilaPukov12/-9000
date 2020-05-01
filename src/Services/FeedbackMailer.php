<?php


namespace App\Services;

use App\Entity\ContactFeedback;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\VarDumper\VarDumper;

class FeedbackMailer
{
    /**
     * @var MailerInterface
     */
    private $mailer;
    /**
     * @var Request|null
     */
    private $route;
    /**
     * @var object|Email
     */
    private $email;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * FeedbackMailer constructor.
     * @param MailerInterface $mailer
     * @param LoggerInterface $logger
     */
    public function __construct(MailerInterface $mailer, LoggerInterface $logger)
    {

        $this->mailer = $mailer;
        $this->logger = $logger;

        $this->email = (new TemplatedEmail())
            ->from('support@mupexpress52.ru')
            ->priority(Email::PRIORITY_LOW)
            ->subject('Обратная связь');

        return $this;
    }

    public function send(ContactFeedback $feedback)
    {
        try {
            $this->email
                ->to($feedback->getMail())
                ->htmlTemplate("emails/feedback.html.twig")
                ->context([
                    'feedback' => $feedback
                ]);
            $this->mailer->send($this->email);
        } catch (TransportExceptionInterface $e) {
            if($_ENV['APP_ENV'] === 'dev') {
                throw new TransportException("Ошибка отправки email сообщения: " . $e->getMessage());
            } else {
                $this->logger->error("Ошибка отправки email сообщения: " . $e->getMessage());
            }
        }
    }
}
