<?php

namespace App\Controller;

use App\Entity\ContactFeedback;
use App\Entity\ContactFeedbackStatus;
use App\Entity\Order;
use App\Entity\OrderStatus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class IndexAdminController extends AbstractController
{
    /**
     * @Route("/admin", name="index_admin")
     */
    public function index()
    {
        if (!$this->getUser()) {
            throw $this->createNotFoundException();
        }

        return $this->render('index_admin/index/index.html.twig', [
            'is_admin_index' => 'active'
        ]);
    }

    /**
     * @Route("/admin/feedback", name="admin_feedback")
     */
    public function feedback()
    {
        if (!$this->getUser()) {
            throw $this->createNotFoundException();
        }

        $em = $this->getDoctrine()->getManager();

        $messages = $em->getRepository(ContactFeedback::class)->findAll();

        $feedbackStatuses = $em->getRepository(ContactFeedbackStatus::class)->findAll();

        return $this->render('index_admin/index/feedback.html.twig', [
            'messages' => $messages,
            'feedback_statuses' => $feedbackStatuses,
            'is_admin_feedback' => 'active'
        ]);
    }

    /**
     * @Route("/admin/set-feedback-status", name="set_feedback_status")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function setFeedbackStatus(Request $request, EntityManagerInterface $em)
    {
        if (!$this->getUser()) {
            throw $this->createNotFoundException();
        }

        $feedback_id = $request->request->get('feedback_id');
        $status_id = $request->request->get('status_id');

        if ($request->isXmlHttpRequest() && $feedback_id && $status_id) {
            $feedback = $em->getRepository(ContactFeedback::class)->findOneBy(['id' => $feedback_id]);
            $status = $em->getRepository(ContactFeedbackStatus::class)->findOneBy(['id' => $status_id]);

            if (is_null($feedback) || is_null($status)) {
                throw $this->createNotFoundException();
            }

            $feedback->setStatus($status);

            $em->persist($feedback);
            $em->flush();

            return new JsonResponse(['status' => 'success']);
        }

        throw $this->createNotFoundException();
    }

    /**
     * @Route("/admin/delete-feedback/{feedback}", name="delete_feedback")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param ContactFeedback $feedback
     * @return Response
     */
    public function deleteFeedback(Request $request, EntityManagerInterface $em, ContactFeedback $feedback)
    {
        if (!$this->getUser()) {
            throw $this->createNotFoundException();
        }

        $feedback_url = $this->generateUrl('admin_feedback', [], UrlGeneratorInterface::ABSOLUTE_URL);
        $redirect_url = $request->headers->get('referer');

        if ($feedback_url !== $redirect_url) {
            throw $this->createNotFoundException();
        }

        $em->remove($feedback);
        $em->flush();

        return $this->redirect($redirect_url);
    }

    /**
     * @Route("/admin/delete-all-feedback", name="delete_all_feedback")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function deleteAllFeedback(Request $request, EntityManagerInterface $em)
    {
        if (!$this->getUser()) {
            throw $this->createNotFoundException();
        }

        $feedback_url = $this->generateUrl('admin_feedback', [], UrlGeneratorInterface::ABSOLUTE_URL);
        $redirect_url = $request->headers->get('referer');

        if ($feedback_url !== $redirect_url) {
            throw $this->createNotFoundException();
        }

        $em->getRepository(ContactFeedback::class)->deleteAll();

        return $this->redirect($redirect_url);
    }

    /**
     * @Route("/admin/order", name="admin_order")
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function order(EntityManagerInterface $em)
    {
        if (!$this->getUser()) {
            throw $this->createNotFoundException();
        }

        $orders = $em->getRepository(Order::class)->findAll();
        $orderStatuses = $em->getRepository(OrderStatus::class)->findAll();

        return $this->render('index_admin/index/order.html.twig', [
            'orders' => $orders,
            'order_statuses' => $orderStatuses,
            'is_admin_order' => 'active'
        ]);
    }

    /**
     * @Route("/admin/set-order-status", name="set_order_status")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function setOrderStatus(Request $request, EntityManagerInterface $em)
    {
        if (!$this->getUser()) {
            throw $this->createNotFoundException();
        }

        $order_id = $request->request->get('order_id');
        $status_id = $request->request->get('status_id');

        if ($request->isXmlHttpRequest() && $order_id && $status_id) {
            $order = $em->getRepository(Order::class)->findOneBy(['id' => $order_id]);
            $status = $em->getRepository(OrderStatus::class)->findOneBy(['id' => $status_id]);

            if (is_null($order) || is_null($status)) {
                throw $this->createNotFoundException();
            }

            $order->setStatus($status);

            $em->persist($order);
            $em->flush();

            return new JsonResponse(['status' => 'success']);
        }

        throw $this->createNotFoundException();
    }

    /**
     * @Route("/admin/delete-order/{order}", name="delete_order")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param Order $order
     * @return Response
     */
    public function deleteOrder(Request $request, EntityManagerInterface $em, Order $order)
    {
        if (!$this->getUser()) {
            throw $this->createNotFoundException();
        }

        $order_url = $this->generateUrl('admin_order', [], UrlGeneratorInterface::ABSOLUTE_URL);
        $redirect_url = $request->headers->get('referer');

        if ($order_url !== $redirect_url) {
            throw $this->createNotFoundException();
        }

        $em->remove($order);
        $em->flush();

        return $this->redirect($redirect_url);
    }

    /**
     * @Route("/admin/delete-all-order", name="delete_all_order")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     */
    public function deleteAllOrder(Request $request, EntityManagerInterface $em)
    {
        if (!$this->getUser()) {
            throw $this->createNotFoundException();
        }

        $order_url = $this->generateUrl('admin_order', [], UrlGeneratorInterface::ABSOLUTE_URL);
        $redirect_url = $request->headers->get('referer');

        if ($order_url !== $redirect_url) {
            throw $this->createNotFoundException();
        }

        $em->getRepository(Order::class)->deleteAll();

        return $this->redirect($redirect_url);
    }
}
