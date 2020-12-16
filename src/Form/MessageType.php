<?php

namespace App\Form;

use App\Entity\Message;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MessageType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, $this->getConfiguration("Votre nom", "indiquer votre nom", [
                'required'=> false
            ]))
            ->add('email', EmailType::class, $this->getConfiguration("Votre email", "indiquer votre mail"))
            ->add('phone', NumberType::class, $this->getConfiguration("Votre numéro de téléphone", "Indiquer votre numéro de téléphone", [
                'required'=> false
            ]))
            ->add('content', TextareaType::class, $this->getConfiguration("Votre message", "Indiquer votre message"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
