<?php 

// src/Controller/FilesController.php 
namespace App\Controller; 

// use generals 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\Routing\Annotation\Route; 
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\String\Slugger\SluggerInterface; 
 
// use for UploadedFile 
use Symfony\Component\HttpFoundation\File\Exception\FileException; 
use Symfony\Component\HttpFoundation\File\UploadedFile; 


// use for Files 
use App\Entity\Files; 
use App\Form\FilesType; 

class FilesController extends AbstractController 

 { 

    // Brochures  
    #[Route('/files/add', name: 'app_files_new')] 

    public function new(Request $request, SluggerInterface $slugger): Response 

    { 
        $files = new Files(); 
        $form = $this->createForm(FilesType::class, $files); 
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
                $files->setBrochureFilename($newFilename); 
            } 
            // ... persist the $files variable or any other work 
            return $this->redirectToRoute('app_dashboard'); 

        } 
        return $this->render('content/files/addFiles.html.twig', [ 

            'form' => $form, 

        ]); 
    }

    #[Route('/files/show', name: 'app_files_show')]
    public function show(): Response
    {
        return $this->render('content/files/showFiles.html.twig', [
            'controller_name' => 'FilesController',
            'files' => 'files'
        ]);
    }

} 

?> 