<?php

namespace App\Controller;

use App\Form\OrderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RouteController extends AbstractController
{
    /**
     * @Route("/routes", name="routes")
     */
    public function index()
    {
        return $this->render('route/index.html.twig', [
            'controller_name' => 'RouteController',
            'form_order' => $this->createForm(OrderType::class)->createView(),
            'is_routes' => 'active'
        ]);
    }
}
