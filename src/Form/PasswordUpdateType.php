<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PasswordUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldPassword', PasswordType::class, array(
                'label' => '',
                'attr' => array( 'placeholder'=> 'Ancien mot de passe'),
            ))
            ->add('newPassword', PasswordType::class, array(
                'label' => '',
                'attr' => array( 'placeholder'=> 'Nouveau mot de passe'),
            ))
            ->add('confirmPassword', PasswordType::class, array(
                'label' => '',
                'attr' => array( 'placeholder'=> 'Confirmation du nouveau mot de passe'),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
