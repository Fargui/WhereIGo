<?php

namespace App\Form;

use App\Entity\Reponse;
use App\Data\TunnelData;
use App\Entity\Question;
use App\Repository\QuestionRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TunnelFormType extends AbstractType {


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('question', EntityType::class, [
                'class' => Question::class,  
            ])
            ->add('reponses', EntityType::class, [
                'class' => Reponse::class, 
                'expanded' => true,
                'label'  =>false,
                'choice_attr' => function () { return array('class' => 'btn btn-succes'); }
            ])
            ->add('send', SubmitType::class, [
            
            ]);
            ;
         $builder->get('reponses')->addEventListener(
             FormEvents::POST_SUBMIT,
             function(FormEvent $event){
                dump($event->getForm());
                dump($event->getForm()->getData()->getAnswer());
                $reponse = $event->getForm()->getData()->getAnswer();

                $listReponse = [];
                array_push($listReponse, $reponse);
                dump($listReponse);
             }
            );
    }
}