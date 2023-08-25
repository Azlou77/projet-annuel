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

 
}
