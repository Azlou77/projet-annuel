<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Entity\User;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\File\File;

class UsersController extends AbstractController
{
    #[Route('/users', name: 'app_users')]
    public function index(): Response
    {
        return $this->render('users/index.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }

    #[Route('/user/files', name: 'app_user_new')]
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $brochureFile */
            $brochureFile = $form->get('brochure')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
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

            return $this->redirectToRoute('app_users');
        }

        return $this->render('users/files/addFiles.html.twig', [
            'form' => $form,
        ]);
    }

    // Display the files of a user
    #[Route('/user/files/{slug}', name: 'app_user_files')]
    public function viewFiles(User $user): Response
    {
        return $this->render('users/files/viewFiles.html.twig', compact('user'));
    }

    public function upload(Request $request)
{
    $file = $request->files->get('file');
    $originalName = $file->getClientOriginalName();
    $targetDirectory = $this->getParameter('kernel.project_dir').'/public/uploads';
    $safeFilename = $originalName;
    $file->move($targetDirectory, $safeFilename);
    
}
}