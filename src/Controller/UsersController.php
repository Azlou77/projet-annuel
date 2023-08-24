<?php

namespace App\Controller;

// use generals
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Doctrine\ORM\EntityManagerInterface;

// use for User
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;





class UsersController extends AbstractController
{
    /**
     * class for manage the users
     *
     * @return Response
     * @method  index() to display the list of users
     * @method  new() to add a new user
     */

    #[Route('/users', name: 'app_users')]
    public function index(): Response 
    {
        /**
         * Function to display the list of users
         * 
         * @Route("/users", name="app_users")
         * @return Response
         * 
         */

        $user = $this->getUser();
        return $this->render('users/index.html.twig', [
            'controller_name' => 'UsersController',
            'user' => $user,
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
