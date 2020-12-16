<?php

namespace App\Form;

use App\Entity\Technic;
use App\Entity\Category;
use App\Entity\Painting;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class EditPaintingType extends ApplicationType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class, $this->getConfiguration("Le titre de la peinture", "indiquer le titre de la peinture"))
            ->add('description', TextareaType::class, $this->getConfiguration("La description de la peinture", "indiquer la description de la peinture"))
            ->add('legende', TextType::class, $this->getConfiguration("La legende de la peinture", "indiquer la legende de la peinture"))
            ->add('width', NumberType::class, $this->getConfiguration("La largeur(cm)", "indiquer la largeur de la peinture"))
            ->add('height', NumberType::class, $this->getConfiguration("La hauteur(cm)", "indiquer la longueur de la peinture"))
            ->add('availability', CheckboxType::class, [
                'label' => "disponible ?",
                'required' => false,
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => function($category){
                    return $category->getName();
                }
            ])
            ->add('technic', EntityType::class, [
                'class' => Technic::class,
                'choice_label' => function($technic){
                    return $technic->getName();
                }
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Painting::class,
        ]);
    }
}
