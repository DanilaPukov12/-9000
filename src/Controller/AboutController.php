<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
            'is_about' => 'active'
        ]);
    }

    /**
     * @Route("/doc", name="documentation")
     */
    public function documentation()
    {
        return $this->render('about/documentation.html.twig', [
            'controller_name' => 'AboutController',
            'is_about' => 'active'
        ]);
    }

    /**
     * @Route("/contacts", name="contacts")
     */
    public function contacts()
    {
        return $this->render('about/contacts.html.twig', [
            'controller_name' => 'AboutController',
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
            'is_services' => 'active'
        ]);
    }
}
