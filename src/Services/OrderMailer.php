<?php


namespace App\Services;

use App\Entity\ContactFeedback;
use App\Entity\Order;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Mailer\Exception\TransportException;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\VarDumper\VarDumper;

class OrderMailer
{
    /**
     * @var MailerInterface
     */
    private $mailer;
    /**
     * @var Request
     */
    private $request;

    /**
     * @var object|Email
     */
    private $email;
    /**
     * @var Request|null
     */
    private $route;
    /**
     * @var LoggerInterface
     */
    private $logger;

    private $attempt = 0;

    /**
     * OrderMailer constructor.
     * @param RequestStack $requestStack
     * @param MailerInterface $mailer
     * @param LoggerInterface $logger
     */
    public function __construct(RequestStack $requestStack, MailerInterface $mailer, LoggerInterface $logger)
    {

        $this->mailer = $mailer;
        $this->route = $requestStack->getCurrentRequest();
        $this->logger = $logger;



        $this->email = (new TemplatedEmail())
            ->from('support@mupexpress52.ru')
            ->priority(Email::PRIORITY_LOW)
            ->subject('МУП "Экспресс" г. Дзержинск');

        return $this;
    }

    public function send(Order $order)
    {
        try {
            $this->email
                ->to($order->getEmail())
                ->htmlTemplate("emails/order.html.twig")
                ->context([
                    'order' => $order
                ]);
            $this->attempt++;
            $this->mailer->send($this->email);
        } catch (TransportExceptionInterface $e) {
            if($this->attempt < 9) {
                $this->send($order);
            }
            if($_ENV['APP_ENV'] === 'dev') {
                throw new TransportException("Ошибка отправки email сообщения: " . $e->getMessage());
            } else {
                $this->logger->error("Ошибка отправки email сообщения: " . $e->getMessage());
            }
        }
    }
}

