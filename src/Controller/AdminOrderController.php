<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminOrderController extends AbstractController
{
    /**
     * @Route("/admin/order", name="admin_order")
     */
    public function index(OrderRepository $repo): Response
    {
        return $this->render('admin/order/index.html.twig', [
            'controller_name' => 'AdminOrderController',
            'orders' => $repo->findAll()
        ]);
    }
    /**
     * Permet d'effacer une peinture
     * 
     * @Route("/admin/order/{id}/delete", name="admin_order_delete")
     *
     * @return void
     */
    public function delete(Order $order, EntityManagerInterface $manager){
        $manager->remove($order);
        $manager->flush();
        $this->addFlash(
            'success',
            "La commande de <strong>{$order->getBuyer()}</strong> a bien ete supprimer !"
        );
        return $this->redirectToRoute("admin_order");
    }
    /**
     * Permet d'afficher un une commande
     *
     * @Route("/admin/order/{id<\d+>}/show", name="admin_order_show")
     * 
     * @param Order $order
     * @return response
     */
    public function show(Order $order):Response 
    {  
        return $this->render('admin/order/show.html.twig',
        [
            "order" => $order
        ]);
    }
}
