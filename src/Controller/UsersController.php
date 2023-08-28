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
use App\Entity\Files; // Ajout de l'import pour l'entité Files
use Doctrine\ORM\EntityManagerInterface;

class UsersController extends AbstractController
{
    #[Route('/users', name: 'app_users')]
    public function index(): Response 
    {
        return $this->render('users/index.html.twig', [
            'controller_name' => 'UsersController',
        ]);
    }

    #[Route('/users/files', name: 'app_user_new')]
    public function new(Request $request, SluggerInterface $slugger, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // ... (rest of your code)
        }

        // ... (rest of your code)
    }

    #[Route('/users/files/{slug}', name: 'app_user_files')]
    public function viewFiles(User $user): Response
    {
        return $this->render('users/files/viewFiles.html.twig', compact('user'));
    }

    #[Route('/upload', name: 'upload', methods: "GET")]
    public function upload(Request $request, EntityManagerInterface $entityManager): Response
    {
        $uploadedFile = $request->files->get('file');

        if (!$uploadedFile) {
            return $this->json(['message' => 'No file uploaded'], 400);
        }

        $destination = 'uploads/';
        $filename = uniqid() . '-' . $uploadedFile->getClientOriginalName();
        $uploadedFile->move($destination, $filename);

        $size = $uploadedFile->getSize();
        $mimeType = $uploadedFile->getClientMimeType();
        $user = $this->getUser(); // Make sure you have a proper user authentication setup

        $newFile = new Files();
        $newFile->setFileName($filename);
        $newFile->setFileSize($size);
        $newFile->setFileType($mimeType);
        $newFile->setFileUrl($destination . $filename);
        $newFile->setUser($user);
        $entityManager->persist($newFile);
        $entityManager->flush();

        $sizeGb = $size / (1024 * 1024 * 1024);
        $user->setUsedStockage($user->getUsedStockage() + $sizeGb);

        if ($user->getUsedStockage() > $user->getStockageLimit()) {
            return $this->json(['message' => 'Vous avez dépassé votre quota de stockage'], 400);
        } else {
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->json($newFile, 201);
        }
    }
}
