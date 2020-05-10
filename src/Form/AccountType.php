<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AccountType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email')
            ->add('firstname',null,[
                'label' => 'Prénom',
                'attr' => array( 'placeholder'=> 'Prénom'),
            ])
            ->add('lastname',null,[
                'label' => "Nom de famille",
                'attr' => array( 'placeholder'=> 'Nom'),
            ])
            ->add('address',null,[
                'label' => 'Adresse',
                'attr' => array( 'placeholder'=> 'Adresse'),
            ])
            ->add('zip_code',null,[
                'label' => 'Code postal',
                'attr' => array( 'placeholder'=> 'Code postal'),
            ])
            ->add('city',null,[
                'label' => 'Ville',
                'attr' => array( 'placeholder'=> 'Ville'),
            ])
            ->add('country',null,[
                'label' => 'Pays',
                'attr' => array( 'placeholder'=> 'Pays'),
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
