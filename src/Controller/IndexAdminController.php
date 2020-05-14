<?php

namespace App\Controller;

use App\Entity\ContactFeedback;
use App\Entity\ContactFeedbackStatus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexAdminController extends AbstractController
{
    /**
     * @Route("/admin", name="index_admin")
     */
    public function index()
    {
        return $this->render('index_admin/index/index.html.twig', [
            'is_admin_index' => 'active'
        ]);
    }

    /**
     * @Route("/admin/feedback", name="admin_feedback")
     */
    public function feedback() {
        $em = $this->getDoctrine()->getManager();

        $messages = $em->getRepository(ContactFeedback::class)->findAll();

        $feedbackStatuses = $em->getRepository(ContactFeedbackStatus::class)->findAll();

        return $this->render('index_admin/index/feedback.html.twig', [
            'messages' => $messages,
            'feedback_statuses' => $feedbackStatuses,
            'is_admin_feedback' => 'active'
        ]);
    }
}
