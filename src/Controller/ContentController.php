<?php

namespace App\Controller;


// use generals
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

// use for UploadedFile
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
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

        $files = scandir('C:\xampp\htdocs\projet-annuel\public\uploads\brochures');
        return $this->render('content/dashboard.html.twig', compact('files'));
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

        // Brochures page

        #[Route('/user/files', name: 'app_brochures_new')]
        public function new(Request $request, SluggerInterface $slugger): Response
        {
            /**
             * Function to add a new user
             * 
             * @Route("/user/new", name="app_user_new")
             * @return Response
             * @param Request $request to get the form
             * @param SluggerInterface $slugger to slug the name of the file
             * 
             */

            $user = new User();
            $form = $this->createForm(UserType::class, $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                /** @var UploadedFile $brochureFile */
                $brochureFile = $form->get('brochure')->getData();

                /* this condition is needed because the 'brochure' field is not required
                so the PDF file must be processed only when a file is uploaded */
                if ($brochureFile) {
                    $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);

                    // this is needed to safely include the file name as part of the URL
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                    // Move the file to the directory where brochures are stored
                    try {
                        $brochureFile->move(
                            $this->getParameter('brochures_directory'),
                            $newFilename
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }

                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                    $user->setBrochureFilename($newFilename);
                    
                }

                // ... persist the $user variable or any other work

                return $this->redirectToRoute('app_dashboard');
            }

            return $this->render('users/files/addFiles.html.twig', [
                'form' => $form,
            ]);
        }




    


    

    
}

