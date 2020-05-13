<?php

namespace App\Controller;

use App\Entity\ContactFeedbackStatus;
use App\Form\ContactFeedbackType;
use App\Form\OrderType;
use App\Services\FeedbackMailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

            $feedbackDefaultStatus = $em->getRepository(ContactFeedbackStatus::class)->findOneBy(['name' => 'Не обработано']);
            $feedback->setStatus($feedbackDefaultStatus);

            $em->persist($feedback);
            $em->flush();

            $this->addFlash('form.feedback.success', "Спасибо за сообщение! Оно будет обязательно рассмотрено");

            if(isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'prod') {
                $feedbackMailer->send($feedback);
            }
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
