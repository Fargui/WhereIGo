<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class SearchFormType extends AbstractType {


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('placeHasCategories', EntityType::class, [
                'label'         => false,
                'choice_attr'   => function () { return array('class' => 'flat'); },  
                'required'      => false,
                'class'         => Category::class,
                'expanded'      => true,
                'multiple'      => true,
            ]); 
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