<?php

namespace App\Form;

use App\Entity\Reponse;
use App\Data\TunnelData;
use App\Entity\Question;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use App\Repository\QuestionRepository;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class TunnelFormType extends AbstractType {

   

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('question', EntityType::class, [
                'class' => Question::class,  
                'mapped' => false,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('q')
                    ->orderBy('rand()');  
                    dump($er);
                }
            ])
            ->add('reponses', EntityType::class, [
                'class' => Reponse::class, 
                'expanded' => true,
                'label'  =>false,
                'multiple'  => false,
            ])
           ;
         $builder->get('reponses')->addEventListener(
             FormEvents::POST_SUBMIT,
             function(FormEvent $event){
                dump($event->getForm());
                dump($event->getForm()->getData()->getAnswer());
                $reponse = $event->getForm()->getData()->getAnswer();
             }
            );
    }

    public function getBlockPrefix()
    {
        return '';
    }
}