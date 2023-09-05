<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Products 
use App\Entity\Products;
use App\Repository\ProductsRepository;


/**
 * Class to manage the rendering of the products
 *  ProductsController
 * @package App\Controller
 */

class ProductsController extends AbstractController
{
    /**
     * Function to display the list of products
     * Route to display the list of products
     * @Route("/products", name="app_products_index")
     * @return Response
     */
    public function index(ProductsRepository $productsRepository): Response
    {
        // Get all products
        $products = $productsRepository->findAll();

        // Return the view
        return $this->render('products/index.html.twig', compact('products'));
    }

    /**
     * Function to display the details of a product
     * @Route("products/{slug}", name="details") ex: /products/iphone-12
     * @return  Response
     */
    #[Route('/products/{slug}', name: 'app_details')]
    public function details(Products $product): Response
    {
        // Return the view
        return $this->render('products/details.html.twig', compact('product'));
    }


}