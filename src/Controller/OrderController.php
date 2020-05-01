<?php

namespace App\Controller;

use App\Form\OrderType;
use App\Services\OrderMailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="order")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param OrderMailer $mailer
     * @return RedirectResponse
     */
    public function index(Request $request, EntityManagerInterface $em, OrderMailer $mailer)
    {
        $formOrder = $this->createForm(OrderType::class);
        $formOrder->handleRequest($request);

        if($formOrder->isSubmitted() && $formOrder->isValid()) {
            $order = $formOrder->getData();

            $em->persist($order);
            $em->flush();

            $this->addFlash('form.order.success', 'Спасибо! Мы ответим вам в ближайшее время.');

            if($order->getEmail() !== null)
                $mailer->send($order);
        }

        return $this->redirect($request->headers->get('referer'));
    }
}
