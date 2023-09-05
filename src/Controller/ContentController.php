<?php

namespace App\Controller;


use App\Entity\Content;
use App\Form\ContentType;
use App\Repository\ContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\File;




/*
 * Class to manage the rendering of the content
 * 
 * @class ContentController
 * @package App\Controller
 * @method  index() to display the dashboard page
 * @method  getPrices() to display the prices page
 * @method getBrochures() to display the brochures page
 */

class ContentController extends AbstractController
{

    
   

    // Dashboard page
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {
        /**
         * Function to display the dashboard page
         * 
         * @Route("/dashboard", name="app_dashboard") route to display the dashboard page
         * @return  Response
         * 
         */

        // $files = scandir('C:\xampp\htdocs\projet-annuel\public\uploads\brochures');

        return $this->render('content/dashboard.html.twig');
        // compact('files'));
    }


        // Prices page
        #[Route('/prices', name: 'app_prices')]
        public function viewprices(): Response
        {
            /**
             * Function to display the prices page
             * 
             * @Route("/prices", name="app_prices") route to display the prices page
             * @return  Response
             */ 
            
            return $this->render('content/prices.html.twig');
        }
}
?>
