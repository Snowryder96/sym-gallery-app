<?php

namespace App\Controller;

use App\Entity\Message;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminMessageController extends AbstractController
{
    /**
     * Permet d'afficher les messages
     * 
     * @Route("/admin/messages", name="admin_message")
     * @Security("is_granted('ROLE_USER')")
     * 
     * @param MessageRepository $repo
     * @return Response
     */
    public function index(MessageRepository $repo): Response
    {
        return $this->render('admin/message/index.html.twig', [
            'messages' => $repo->findAll()
        ]);
    }
    /**
     * Permet d'effacer un message
     * 
     * @Route("/admin/messages/{id<\d+>}/delete", name="admin_message_delete")
     * @Security("is_granted('ROLE_USER')")
     *
     * @param Message $message
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delete(Message $message, EntityManagerInterface $manager): Response
    {
        $manager->remove($message);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le message de <strong>{$message->getEmail()}</strong> a bien ete supprimer !"
        );

        return $this->redirectToRoute("admin_message");
    }
    /**
     * Permet d'afficher un message
     *
     * @Route("/admin/messages/{id<\d+>}/show", name="admin_message_show")
     * @Security("is_granted('ROLE_USER')")
     * 
     * @param Message $message
     * @return response
     */
    public function show(Message $message):Response 
    {  
        return $this->render('admin/message/show.html.twig',
        [
            "message" => $message
        ]);
    }
}
