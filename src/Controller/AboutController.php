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
use Symfony\Component\VarDumper\VarDumper;

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
     * @param FeedbackMailer $feedbackMailer
     * @return Response
     */
    public function contacts(Request $request, EntityManagerInterface $em, FeedbackMailer $feedbackMailer)
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
         return $this->render('about/services.html.twig', [
            'controller_name' => 'AboutController',
            'form_order' => $this->createForm(OrderType::class)->createView(),
            'is_services' => 'active'
        ]);
    }

    /**
     * @Route("/user-agreement", name="user_agreement")
     * @param Request $request
     * @return Response
     */
    public function userAgreement(Request $request) {
        return $this->render('about/user-agreement.html.twig', [
            'form_order' => $this->createForm(OrderType::class)->createView(),
            'redirect_url' => $request->headers->get('referer'),
            'is_about' => 'active'
        ]);
    }
}
