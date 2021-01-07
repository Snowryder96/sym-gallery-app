<?php

namespace App\Controller;

use App\Entity\Order;
use App\Form\OrderType;
use App\Entity\Painting;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    /**
     * Permet d'afficher une seule peinture
     *
     * @Route("/paintings/{slug}/order", name="painting_show_order")
     * 
     * @param Painting $painting
     * @return response
     */
    public function show(Painting $painting, Request $request, EntityManagerInterface $manager): Response{
        $order = new Order();
        $form = $this->createForm(OrderType::class, $order);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $order->setPainting($painting);
            $manager->persist($order);
            $manager->flush();
            $this->addFlash(
                'success',
                "Votre demande concernant la peinture <strong>{$painting->getTitle()}</strong> a bien été enregistrée !"
            );
            return $this->redirectToRoute('home');
        }
        return $this->render('order/index.html.twig',
        [
            'painting' => $painting,
            'form' => $form->createView()
        ]);
    }
    
}
