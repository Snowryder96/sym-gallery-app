<?php

namespace App\Form;

use App\Entity\Technic;
use App\Entity\Category;
use App\Entity\Painting;
use App\Form\ApplicationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PaintingType extends ApplicationType
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
            ->add('painting', FileType::class, [
                'label' => 'Painting (JPEG, PNG file)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => true,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid PNG, JPEG image',
                    ])
                ],
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
