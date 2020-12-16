<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdminCategoryController extends AbstractController
{
    /**
     * @Route("/admin/category", name="admin_category")
     */
    public function index(CategoryRepository $repo, EntityManagerInterface $manager, Request $request): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($category);
            $manager->flush();
            $this->addFlash(
                'success',
                "l'annonce <strong>{$category->getName()}</strong> a bien été enregistrée !"
            );
        }
        return $this->render('admin/category/index.html.twig', [
            'categories' => $repo->findAll(),
            'form' => $form->createView(),
        ]);
    }
    /**
     * Permet d'editer une categorie
     * 
     * @Route("/admin/category/{id}/edit", name="admin_category_edit")
     *
     * @return void
     */
    public function edit(Category $category, Request $request, EntityManagerInterface $manager){
        $form = $this->createForm(CategoryType:: class, $category);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($category);
            $manager->flush();

            $this->addFlash(
                'success',
                "les modifications de la categorie <strong>{$category->getName()}</strong> ont bien été enregistrée !"
            );

            return $this->redirectToRoute('admin_category');
        }

        return $this->render('admin/category/edit.html.twig', [
            'form' => $form->createView(),
            'category' => $category
        ]);
    }
    /**
     * Permet d'effacer une categorie
     * 
     * @Route("/admin/category/{id}/delete", name="admin_category_delete")
     *
     * @return void
     */
    public function delete(Category $category, EntityManagerInterface $manager){
        $manager->remove($category);
        $manager->flush();

        $this->addFlash(
            'success',
            "La categorie <strong>{$category->getName()}</strong> a bien ete supprimer !"
        );

        return $this->redirectToRoute("admin_category");
    }
}
