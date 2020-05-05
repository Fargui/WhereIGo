<?php

namespace App\Form;



use App\Data\SearchData;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class SearchFormType extends AbstractType {


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('placeHasCategories', EntityType::class, [
<<<<<<< HEAD
                'label'         => false,  
=======
                'label'         => false, 
>>>>>>> 4169ba6abc8b63ed50867c57a50d6bcee647995b
                'required'      => false,
                'class'         => Category::class,
                'expanded'      => true,
                'multiple'      => true,
            ])

            ->add('q', TextType::class, [
                'label'         => false,       
                'required'      => false,
                'attr'          =>[
                  'placeholder' => 'Rechercher'
                ]
            ])

            ->add('min', NumberType::class, [
                'label'         => false,       
                'required'      => false,
                'attr'          =>[
                    'placeholder'=> 'Prix min'
                ]
            ])

            ->add('max', NumberType::class, [
                'label'         => false,       
                'required'      => false,
                'attr'          =>[
                  'placeholder' => 'Prix max'
                ]
            ])

     

            ->add('valider', SubmitType::class, [
                'attr' => ['class' => 'btn btn-primary'],
            ]);
            
            ; 
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'      => SearchData::class,
            'method'          => 'GET',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

  
    // public function buildForm(FormBuilderInterface $builder, array $options)
    // {
    //     $builder
           
    //         ->add('plage', ButtonType::class)
    //         ->add('foret', ButtonType::class)
    //         ->add('ville', ButtonType::class)
    //         ->add('montagne', ButtonType::class)

    //         ->add('Valider_la_categorie', SubmitType::class)
    //     ;
    // }

    // public function configureOptions(OptionsResolver $resolver)
    // {
    //     $resolver->setDefaults([
    //         'data_class' => Place::class,
    //     ]);
    // }


}