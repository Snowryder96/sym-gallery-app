<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Technic;
use App\Form\TechnicType;
use App\Repository\TechnicRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminTechnicController extends AbstractController
{
    /**
     * @Route("/admin/technic", name="admin_technic")
     */
    public function index(TechnicRepository $repo, EntityManagerInterface $manager, Request $request): Response
    {
        $technic = new Technic();
        $form = $this->createForm(TechnicType::class, $technic);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($technic);
            $manager->flush();
            $this->addFlash(
                'success',
                "La technique <strong>{$technic->getName()}</strong> a bien été enregistrée !"
            );
        }
        return $this->render('admin/technic/index.html.twig', [
            'technics' => $repo->findAll(),
            'form' => $form->createView(),
        ]);
    }
    /**
     * Permet d'effacer une technic
     * 
     * @Route("admin/technic/{id}/delete", name="admin_technic_delete")
     */
    public function delete(Technic $technic, EntityManagerInterface $manager){
        $manager->remove($technic);
        $manager->flush();

        $this->addFlash(
            'success',
            "La technique <strong>{$technic->getName()}</strong> a bien ete supprimer !"
        );

        return $this->redirectToRoute("admin_technic");
    }
    /**
     * Permet de modifier une technic
     * 
     * @Route("admin/technic/{id}/edit", name="admin_technic_edit")
     */
    public function edit(Technic $technic, EntityManagerInterface $manager, Request $request){
        $form = $this->createForm(TechnicType:: class, $technic);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($technic);
            $manager->flush();

            $this->addFlash(
                'success',
                "les modifications de la technique <strong>{$technic->getName()}</strong> ont bien été enregistrée !"
            );

            return $this->redirectToRoute('admin_technic');
        }

        return $this->render('admin/technic/edit.html.twig', [
            'form' => $form->createView(),
            'technic' => $technic
        ]);
    }
}
