<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AccountController extends AbstractController
{
    /**
     * @Route("/account", name="account")
     */
    public function index(): Response
    {
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
    /**
     * Permet d'afficher et de gerer le formulaire de connexion
     * 
     * @Route("/login", name="account_login")
     * 
     * @return Response
     */
    public function login(AuthenticationUtils $utils)
    {
        if($this->getUser()) {
            $this->addFlash(
                'warning',
                "Vous êtes déjà connecté !"
            );
            return $this->redirectToRoute('home');
        }

        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();

        return $this->render('account/login.html.twig', [
            'Error' => $error,
            'username' => $username
        ]);
    }
    /**
     * Permet de se deconnecter
     * 
     * @Route("/logout", name="account_logout")
     *
     * @return void
     */
    public function logout(){
        //...rien 
    }
}
