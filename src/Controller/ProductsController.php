<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Products;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class to manage the rendering of the products
 * @class ProductsController
 * @package App\Controller
 * 
 * 
 */

class ProductsController extends AbstractController
{
    /**
     * Function to display the list of products
     * 
     * Route to display the list of products
     * @Route("/products", name="app_products_")
     * @return Response
     */
    #[Route('/products', name: 'app_products')]
    public function index(): Response
    {
        // Return the view
        return $this->render('products/index.html.twig');
    }

    /**
     * Function to display the details of a product
     * 
     * @Route("/{slug}", name="details") ex: /products/iphone-12
     * @return  Response
     */
    #[Route('products/{slug}', name: 'app_details')]
    public function details(Products $product): Response
    {
        // Return the view
        return $this->render('products/details.html.twig', compact('product'));
    }


}