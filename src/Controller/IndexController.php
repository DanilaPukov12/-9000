<?php

namespace App\Controller;

use App\Entity\ContactFeedback;
use App\Form\ContactFeedbackType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route("/", name="index")
     */
    public function index(Request $request)
    {
        $contactFeedback = new ContactFeedback();
        $formFeedback = $this->createForm(ContactFeedbackType::class, $contactFeedback);

        $formFeedback->handleRequest($request);

        $formFeedbackIsSend = $this->session->get('form_feedback_is_send') ?? false;
        $this->session->remove('form_feedback_is_send');

        if ($formFeedback->isSubmitted() && $formFeedback->isValid()) {
            $contactFeedback = $formFeedback->getData();
            $contactFeedback->setCreatedAt(new \DateTime('now'));

            $em = $this->getDoctrine()->getManager();

            $em->persist($contactFeedback);
            $em->flush();

            $this->session->set('form_feedback_is_send', true);

            return $this->redirectToRoute('index');
        }

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'form_feedback' => $formFeedback->createView(),
            'form_feedback_is_send' => $formFeedbackIsSend,
            'is_home' => 'active'
        ]);
    }
}
