<?php

namespace App\Controller;

use App\Form\ContactFeedbackType;
use App\Form\OrderType;
use App\Services\FeedbackMailer;
use App\Services\OrderMailer;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param FeedbackMailer $feedbackMailer
     * @return Response
     */
    public function index(Request $request, EntityManagerInterface $em, FeedbackMailer $feedbackMailer)
    {
        $formFeedback = $this->createForm(ContactFeedbackType::class);
        $formFeedback->handleRequest($request);

        if($formFeedback->isSubmitted() && $formFeedback->isValid()) {
            $feedback = $formFeedback->getData();

            $em->persist($feedback);
            $em->flush();

            $this->addFlash('form.feedback.success', "Спасибо за сообщение! Оно будет обязательно рассмотрено");

            $feedbackMailer->send($feedback);

            return $this->redirectToRoute('index');
        }

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'form_feedback' => $formFeedback->createView(),
            'form_order' => $this->createForm(OrderType::class)->createView(),
            'is_home' => 'active'
        ]);
    }
}
