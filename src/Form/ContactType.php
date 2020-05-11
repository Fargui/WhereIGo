<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, array(
                'label' => "",
                'attr' => array( 'placeholder'=> 'Prénom'),
            ))
            ->add('lastname', TextType::class, array(
                'label' => "",
                'attr' => array( 'placeholder'=> 'Nom'),
                ))
            ->add('email', EmailType::class, array(
                'label' => "",
                'attr' => array( 'placeholder'=> 'E-mail'),
            ))
            ->add('message', TextareaType::class, array(
                'label' => "",
                'attr' => array( 'placeholder'=> 'Message'),
                
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
