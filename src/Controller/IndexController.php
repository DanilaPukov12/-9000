<?php

namespace App\Controller;

use App\Form\ContactFeedbackType;
use App\Form\OrderType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function index(Request $request, EntityManagerInterface $em)
    {
        $formFeedback = $this->createForm(ContactFeedbackType::class);
        $formFeedback->handleRequest($request);


        if($formFeedback->isSubmitted() && $formFeedback->isValid()) {
            $feedback = $formFeedback->getData();

            $em->persist($feedback);
            $em->flush();

            $this->addFlash('form.feedback.success', "Спасибо за сообщение! Оно будет обязательно рассмотрено");

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
