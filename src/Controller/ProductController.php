<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

// Product 
use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Form\ProductType;


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
     * @Route("/products", name="app_products_index")
     * @return Response
     */
    public function index(ProductRepository $productRepository): Response
    {
        // Get all Product
        $product = $productRepository->findAll();

        // Return the view
        return $this->render('product/index.html.twig', 
        [
            'products' => $product
        ]);
    }

    /**
     * Function to add new product
     * @Route("/product/new", name="app_product_new")
     * @return Response
     */

    
    public function new(Request $request, ProductRepository $productRepository): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $productRepository->save($product, true);

            return $this->redirectToRoute('app_product_index');
        }

        return $this->render('product/new.html.twig', [
            'form' => $form->createView(),
            'product' => $product,
            'user' => $user
        ]);
        
    
     }



    /**
     * Function to display the details of a product
     * @Route("Product/{slug}", name="app_Product_details") ex: /Product/iphone-12
     * @return  Response
     */
    #[Route('/product/{slug}', name: 'app_details')]
    public function details(Product $product): Response
    {
        // Return the view
        return $this->render('Product/details.html.twig', compact('product'));
    }


}