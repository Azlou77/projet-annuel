<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ContentController extends AbstractController
{
    //Prices page
    #[Route('/prices', name: 'app_prices')]
    public function viewprices(): Response
    {
        return $this->render('content/prices.html.twig', [
            'controller_name' => 'ContentController',
        ]);
    }
}
