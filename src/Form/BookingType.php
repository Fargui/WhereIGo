<?php

namespace App\Form;

use App\Entity\Booking;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\DataTransformer\FrenchToDateTimeTransformer;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class BookingType extends AbstractType

{

private $transformer;

    public function __construct(FrenchToDateTimeTransformer $transformer)
    {
        $this->transformer = $transformer;
    }
 
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('start_at', HiddenType::class,[
                'label' => false,
            ])
            ->add('end_at', HiddenType::class,[
                'label' => false,
                      
            ])           
        ;

        $builder->get('start_at')->addModelTransformer($this->transformer);
        $builder->get('end_at')->addModelTransformer($this->transformer);

    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}
