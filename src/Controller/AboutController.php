<?php

namespace App\Controller;

use App\Form\ContactFeedbackType;
use App\Form\OrderType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route("/about", name="about")
     */
    public function index()
    {
        return $this->render('about/index.html.twig', [
            'controller_name' => 'AboutController',
            'form_order' => $this->createForm(OrderType::class)->createView(),
            'is_about' => 'active'
        ]);
    }

    /**
     * @Route("/executives", name="executives")
     */
    public function executives()
    {
        return $this->render('about/executives.html.twig', [
            'controller_name' => 'AboutController',
            'form_order' => $this->createForm(OrderType::class)->createView(),
            'is_about' => 'active'
        ]);
    }

    /**
     * @Route("/study", name="study")
     */
    public function study()
    {
        return $this->render('about/study.html.twig', [
            'controller_name' => 'AboutController',
            'form_order' => $this->createForm(OrderType::class)->createView(),
            'is_about' => 'active'
        ]);
    }

    /**
     * @Route("/documentation", name="documentation")
     */
    public function documentation()
    {
        return $this->render('about/documentation.html.twig', [
            'controller_name' => 'AboutController',
            'form_order' => $this->createForm(OrderType::class)->createView(),
            'is_about' => 'active'
        ]);
    }

    /**
     * @Route("/contacts", name="contacts")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function contacts(Request $request, EntityManagerInterface $em)
    {
        $formFeedback = $this->createForm(ContactFeedbackType::class);
        $formFeedback->handleRequest($request);

        if($formFeedback->isSubmitted() && $formFeedback->isValid()) {
            $feedback = $formFeedback->getData();

            $em->persist($feedback);
            $em->flush();

            $this->addFlash('form.feedback.success', "Спасибо за сообщение! Оно будет обязательно рассмотрено");

            return $this->redirectToRoute('contacts');
        }

        return $this->render('about/contacts.html.twig', [
            'controller_name' => 'AboutController',
            'form_feedback' => $formFeedback->createView(),
            'form_order' => $this->createForm(OrderType::class)->createView(),
            'is_contacts' => 'active'
        ]);
    }

    /**
     * @Route("/services", name="services")
     */
    public function services()
    {
        $formOrder2 = $this->createForm(OrderType::class);

        return $this->render('about/services.html.twig', [
            'controller_name' => 'AboutController',
            'form_order' => $this->createForm(OrderType::class)->createView(),
            'form_order2' => $this->createForm(OrderType::class)->createView(),
            'is_services' => 'active'
        ]);
    }
}
