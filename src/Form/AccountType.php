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
                'label' => 'Prénom'
            ])
            ->add('lastname',null,[
                'label' => "Nom de famille"
            ])
            ->add('address',null,[
                'label' => 'Adresse'
            ])
            ->add('zip_code',null,[
                'label' => 'Code postal'
            ])
            ->add('city',null,[
                'label' => 'Ville'
            ])
            ->add('country',null,[
                'label' => 'Pays'
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
