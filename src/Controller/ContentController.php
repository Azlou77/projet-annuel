<?php

namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



/*
 * Class to manage the rendering of the content
 * @class ContentController
 * @package App\Controller
 * 
 * Route to display the prices page
 * @Route("/prices", name="app_prices")
 * @return  Response
 * 
 * Route to display the dashboard page
 * @Route("/dashboard", name="app_dashboard")
 * @return  Response
 * 
 */

class ContentController extends AbstractController
{
    // Prices page
    #[Route('/prices', name: 'app_prices')]
    public function viewprices(): Response
    {
        return $this->render('content/prices.html.twig');
    }

    // Dashboard page
    #[Route('/dashboard', name: 'app_dashboard')]
    public function viewdashboard(): Response
    {
        return $this->render('content/dashboard.html.twig');
    }

    
}

