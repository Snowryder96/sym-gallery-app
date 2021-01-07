<?php

namespace App\Form;

use App\Entity\Order;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class OrderType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('buyer', TextType::class, $this->getConfiguration("Votre nom", "indiquer votre nom", [
                'required'=> true
            ]))
            ->add('email', EmailType::class, $this->getConfiguration("Votre email", "indiquer votre mail", [
                'required'=> true
            ]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
