<?php 

// src/Controller/FilesController.php 
namespace App\Controller; 

// use generals 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response; 
use Symfony\Component\Routing\Annotation\Route; 
use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\String\Slugger\SluggerInterface; 
 
// use for UploadedFile 
use Symfony\Component\HttpFoundation\File\Exception\FileException; 
use Symfony\Component\HttpFoundation\File\UploadedFile; 


// use for Files 
use App\Entity\Files; 
use App\Form\FilesType;
use App\Repository\FilesRepository;

class FilesController extends AbstractController 

 { 
    /** 
     * class for manage the files 
     * 
     * @return Response 
     * @method  index() to display the list of files 
     * @method  new() to add a new file 
     */

    #[Route('/files/add', name: 'app_files_new')] 
    public function new(Request $request, SluggerInterface $slugger): Response 

    { 
        /** 
         * Function to add a new file 
         * 
         * @Route("/files/add", name="app_files_new") 
         * @return Response 
         * 
         */

        $files = new Files(); 
        $form = $this->createForm(FilesType::class, $files); 
        $form->handleRequest($request); 

        if ($form->isSubmitted() && $form->isValid()) { 

            /** @var UploadedFile $brochureFile */ 
            $brochureFile = $form->get('name')->getData();

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
                $files->setName($newFilename); 
            } 
            // ... persist the $files variable or any other work 
            return $this->redirectToRoute('app_dashboard'); 

        } 
        // display the template to add a new file
        return $this->render('content/files/addFiles.html.twig', [ 

            'form' => $form, 

        ]); 
    }

    #[Route('/files/view', name: 'app_files')]
    public function showFiles(FilesRepository $filesRepository): Response

    { 
        /** 
         * Function to display the list of files 
         * 
         * @Route("/files", name="app_files") 
         * @return Response 
         * 
         */ 

        $files = $filesRepository->findAll();

        


        return $this->render('content/files/viewFiles.html.twig', [ 

            'files' => $files, 

        ]);
    }
}
    
?>
