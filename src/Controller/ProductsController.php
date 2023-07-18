<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Products;

/*
 * Class to manage the rendering of the products
 * @class ProductsController
 * @package App\Controller
 * 
 * Route to display the list of products
 * @Route("/products", name="app_products_")
 * @return  Response
 * 
 * Route to search for a product by its slug(product name)
 * @Route("/{slug}", name="details") ex: /products/iphone-12
 * @return  Response
 * 
 */

class ProductsController extends AbstractController
{
    // Display the list of products
    #[Route('/products', name: 'app_products')]
    public function index(): Response
    {
        // Get all the products
        return $this->render('products/index.html.twig');
    }

    // Display the details of a product
    #[Route('products/{slug}', name: 'app_details')]
    public function details(Products $product): Response
    {
        // Get the product by its slug
        return $this->render('products/details.html.twig', compact('product'));
    }
    
}
