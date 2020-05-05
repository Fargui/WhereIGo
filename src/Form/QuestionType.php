<?php

namespace App\Form;

use App\Entity\Reponse;
use App\Entity\Question;
use App\Data\QuestionData;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;


class QuestionType extends AbstractType {


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('reponseHasQuestion', EntityType::class, [
                'label'         => false,
                'required'      => false,
                'class'         => Question::class,
                'expanded'      => false,
                'mapped'        => false,
                'multiple'      => true,
            ])
            ->add('questionHasReponse', EntityType::class, [
                'label'         => false,
                'required'      => false,
                'class'         => Reponse::class,
                'expanded'      => false,
                'multiple'      => true,
            ])
            ->add('Envoi', SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'      => QuestionData::class,
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