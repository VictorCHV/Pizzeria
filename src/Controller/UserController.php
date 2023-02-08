<?php

namespace App\Controller;

use App\Form\RegistrationType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/inscription", name="app_user_registration")
     */

     public function registration(UserRepository $repository, Request $request, UserPasswordHasherInterface $hasher): Response
     {
         // création du formulaire
         $form = $this->createForm(RegistrationType::class);

         // remplissage formulaire avec les données de l'utilisateur
         $form->handleRequest($request);

         // verification si le form est envoyé et valide
         if ($form->isSubmitted() && $form->isValid()) {
             //récuperer les données de l'utilisateur
             $user= $form->getData();

           //crypter le mot de passe
             $cryptedPass= $hasher->hashPassword($user, $user->getPassword()); // c'est ici que le mdp ecrit en clair se transforme en hash
             $user->setPassword($cryptedPass);

             //Enregistrer l'utilisateur dans la DB
             $repository->save($user, true);

             //redirection vers la page d'accueil
             return $this->redirectToRoute('app_pizza_home');
         }

         return $this->render('user/registration.html.twig', [
            'form' => $form->createView(),
        ]);
     }

     #[Route(path: '/login', name: 'app_login')]
     public function login(AuthenticationUtils $authenticationUtils): Response
     {
         // if ($this->getUser()) {
         //     return $this->redirectToRoute('target_path');
         // }

         // get the login error if there is one
         $error = $authenticationUtils->getLastAuthenticationError();
         // last username entered by the user
         $lastUsername = $authenticationUtils->getLastUsername();

         return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
     }

     #[Route(path: '/logout', name: 'app_logout')]
     public function logout(): void
     {
         throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
     }
}
