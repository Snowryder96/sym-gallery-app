<?php

namespace App\Controller;

use App\Entity\Painting;
use App\Form\EditPaintingType;
use App\Form\PaintingType;
use Symfony\Component\Finder\Finder;
use App\Repository\PaintingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class AdminPaintingController extends AbstractController
{
    /**
     * Permet d'afficher les peintures
     * 
     * @Route("/admin/paintings", name="admin_painting")
     * @Security("is_granted('ROLE_USER')")
     */
    public function index(PaintingRepository $repo): Response
    {
        return $this->render('admin/painting/index.html.twig', [
            'paintings' => $repo->findAll()
        ]);
    }
    /**
     * Permet de creer une peinture
     *
     * @Route("/admin/painting/new", name="admin_painting_new")
     * @Security("is_granted('ROLE_USER')")
     * 
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param SluggerInterface $slugger
     * @return Response 
     */
    public function create(Request $request, EntityManagerInterface $manager, SluggerInterface $slugger): Response
    {

        $painting = new Painting();

        $form = $this->createForm(PaintingType:: class, $painting);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $paintingFile = $form->get('painting')->getData();
            if ($paintingFile) {
                $originalFilename = pathinfo($paintingFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$paintingFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $paintingFile->move(
                        $this->getParameter('paintings_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $painting->setPaintingFilename($newFilename);
                $manager->persist($painting);
                $manager->flush();
                $this->addFlash(
                    'success',
                    "l'annonce <strong>{$painting->getTitle()}</strong> a bien été enregistrée !"
                );
            }
            // Redirrection vers la nouvelle peinture creé
            return $this->redirectToRoute('painting_show', [
                'slug' =>$painting->getSlug()
            ]);
        }
        // Affichage du formulaire de céation d'une peinture
        return $this->render('/admin/painting/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * Permet d'editer une peinture
     * 
     * @Route("/admin/painting/{slug}/edit", name="admin_painting_edit")
     * @Security("is_granted('ROLE_USER')")
     * 
     * 
     * @param EntityManagerInterface $manager
     * @param Resquest $request
     * @param Painting $painting
     * @return Response
     */
    public function edit(Painting $painting, Request $request, EntityManagerInterface $manager): Response
    {

        $form = $this->createForm(EditPaintingType:: class, $painting);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            

            $manager->persist($painting);
            $manager->flush();

            $this->addFlash(
                'success',
                "les modifications de la peinture <strong>{$painting->getTitle()}</strong> ont bien été enregistrée !"
            );

            return $this->redirectToRoute('painting_show', [
                'slug' =>$painting->getSlug()
            ]);
        }

        return $this->render('painting/edit.html.twig', [
            'form' => $form->createView(),
            'painting' => $painting
        ]);
        
    }
    /**
     * Permet de supprimer une peinture
     * 
     * @Route("/admin/painting/{slug}/delete", name="admin_painting_delete")
     * @Security("is_granted('ROLE_USER')"), message="Vous n'avez pas le droit d'acceder a cette ressource")
     *
     * @param Painting $painting
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Painting $painting, EntityManagerInterface $manager): Response{
        $finder= new Finder();
        // "C:\Users\masuy\code\Gallery-app\Gallery-App\public\uploads\paintings"
        
        $fileName = $painting->getPaintingFilename();
        $finder->files()->in(__DIR__.'/../../public/uploads/');
        foreach($finder as $file){
            if(strpos($file->getRealPath(), $fileName)){
                unlink($file->getRealPath());
                $manager->remove($painting);
                $manager->flush();

                $this->addFlash(
                    'success',
                    "l'annonce <strong>{$painting->getTitle()}</strong> a bien ete supprimer !"
                );
            }
        }
        

        return $this->redirectToRoute("admin_painting");
    }
}
