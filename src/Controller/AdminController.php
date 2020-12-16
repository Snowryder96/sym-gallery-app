<?php

namespace App\Controller;

use App\Entity\Technic;
use App\Entity\Category;
use App\Form\TechnicType;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use App\Repository\PaintingRepository;
use App\Repository\TechnicRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_index")
     */
    public function index(PaintingRepository $repo): Response
    {
        return $this->render('admin/painting/index.html.twig', [
            'paintings'=> $repo->findAll()
        ]);
    }
}
