<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Product 
use App\Entity\Product;
use App\Repository\ProductRepository;


/**
 * Class to manage the rendering of the Product
 *  ProductController
 * @package App\Controller
 */

class ProductController extends AbstractController
{
    /**
     * Function to display the list of Product
     * Route to display the list of Product
     * @Route("/Product", name="app_Product_index")
     * @return Response
     */
    public function index(ProductRepository $productRepository): Response
    {
        // Get all Product
        $Product = $productRepository->findAll();

        // Return the view
        return $this->render('Product/index.html.twig', compact('Product'));
    }

    /**
     * Function to display the details of a product
     * @Route("Product/{slug}", name="app_Product_details") ex: /Product/iphone-12
     * @return  Response
     */
    #[Route('/Product/{slug}', name: 'app_details')]
    public function details(Product $product): Response
    {
        // Return the view
        return $this->render('Product/details.html.twig', compact('product'));
    }


}