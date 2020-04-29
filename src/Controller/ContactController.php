<?php

namespace App\Controller;

use App\Entity\ContactFeedback;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact/feedback", name="contactFeedback")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        $messages = $em->getRepository(ContactFeedback::class)->findAll();


        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController',
            'messages' => $messages
        ]);
    }
}
