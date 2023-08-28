<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Products; // Assurez-vous que c'est le bon chemin vers votre entité Products
use Doctrine\ORM\EntityManagerInterface;

class ProductsController extends AbstractController
{
    /**
     * Function to display the list of products
     * 
     * @Route("/products", name="app_products")
     * @return Response
     */
    public function index(): Response
    {
        // Return the view
        return $this->render('products/index.html.twig');
    }

    /**
     * Function to display the details of a product
     * 
     * @Route("/products/{slug}", name="app_details")
     * @return Response
     */
    public function details(Products $product): Response
    {
        // Return the view
        return $this->render('products/details.html.twig', compact('product'));
    }
}
