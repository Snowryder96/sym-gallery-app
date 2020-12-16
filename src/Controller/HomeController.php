<?php

namespace App\Controller;

use App\Repository\PaintingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * Permet d'afficher la page d'acceuil
     * 
     * @Route("/", name="home")
     */
    public function index(PaintingRepository $repo): Response
    {
        return $this->render('home/index.html.twig', [
            'lastPaintings' => $repo->findBy(array(),array('id'=>'DESC'),3,0)
        ]);
    }
    
}
