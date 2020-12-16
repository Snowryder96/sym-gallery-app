<?php

namespace App\Controller;

use App\Entity\Painting;
use Symfony\Component\Asset\Package;
use Symfony\Component\Finder\Finder;
use App\Repository\TechnicRepository;
use App\Repository\CategoryRepository;
use App\Repository\PaintingRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\VersionStrategy\StaticVersionStrategy;


class PaintingController extends AbstractController
{
    /**
     * Permet d'afficher les peintures
     * 
     * @Route("/paintings", name="painting_index")
     * 
     * @param PaintingRpository $repo
     * @return Response
     */
    public function index(PaintingRepository $repo, CategoryRepository $catRepo, TechnicRepository $techRepo): Response
    {
        return $this->render('painting/index.html.twig', [
            'paintings' => $repo->findAll(),
            'categories' => $catRepo->findAll(),
            'technics' => $techRepo->findAll()
        ]);
    }
    /**
     * Permet d'afficher une seule peinture
     *
     * @Route("/paintings/{slug}", name="painting_show")
     * 
     * @param Painting $painting
     * @return response
     */
    public function show(Painting $painting): Response{
        return $this->render('painting/show.html.twig',
        [
            "painting" => $painting
        ]);
    }
    
}
