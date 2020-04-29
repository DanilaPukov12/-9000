<?php

namespace App\Controller;

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
            'is_routes' => 'active'
        ]);
    }
}
