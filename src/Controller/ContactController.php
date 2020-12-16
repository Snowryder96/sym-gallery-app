<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Repository\RepositoryFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * Permet d'afficher le formulaire de contact
     * 
     * @Route("/contact", name="contact")
     * 
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function index(Request $request, EntityManagerInterface $manager): Response
    {

        $message = new Message();

        $form = $this->createForm(MessageType:: class, $message);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){

            $manager->persist($message);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre message a bien été enregistrée !"
            );

            return $this->redirectToRoute('home');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
