<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, array(
                'label' => "Nom d'utilisateur",
                'attr' => array( 'placeholder'=> 'Nom d\'utilisateur'),
                'help' => "Le nom affiché pour les autres utilisateurs"
            ))
            ->add('email', EmailType::class, array(
                'label' => "E-mail",
                'attr' => array( 'placeholder'=> 'E-mail'),
            ))
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Mot de passe', 'attr' =>['placeholder'=> 'Mot de passe'] ],
                
                'second_options' => ['label' => 'Confirmation du mot de passe', 'attr' =>['placeholder'=> 'Confirmation de mot de passe']],
                'invalid_message' => "Les mots de passe ne correspondent pas."
            ))
            ->add('firstname', null, array(
                'label' => "Prénom",
                'attr' => array( 'placeholder'=> 'Prénom'),
            ))
            ->add('lastname', null, array(
                'label' => "Nom",
                'attr' => array( 'placeholder'=> 'Nom'),
            ))
            ->add('birthday', BirthdayType::class, array(
                'label' => "Date de naissance",
                'format' => 'ddMMMMy',
                'placeholder' => array(
                    'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour',
                )
            ))
            ->add('address', HiddenType::class)
            ->add('zip_code', HiddenType::class)
            ->add('city', HiddenType::class)
            ->add('country', HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
