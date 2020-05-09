<?php

namespace App\Form;

use App\Entity\Reponse;
use App\Repository\QuestionRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TunnelFormType extends AbstractType {

    private $questions;

    public function __construct( QuestionRepository $questionRepository){
        $this->questions = $questionRepository->findAll();     
    }
    

    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        //Pour 
        $id = 0;

        foreach($this->questions as $question){
            
            $id++;
            
            $builder
            
            
            ->add('reponse_'.$id,EntityType::class, [
                'class' => Reponse::class,  
                'mapped' => false,
                'multiple'  => false,
                'expanded' => true,
                'row_attr' => ['class' => 'question_'.$id.' question'],
                'label' => $question->getAsk(),
                'choices'=> $question->getReponseHasQuestion(),
                
            ])
            
            ->add('valider', SubmitType::class, [
                'label' => "Voir le wig qui me correspond",
            ])
            ;
        }}

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
                
                'method'          => 'GET',
                'csrf_protection' => false,
            ]);
        }

    

        public function getBlockPrefix()
        {
            return '';
        }
}

        /* $builder

            ->add('question', EntityType::class, [
                'class' => Question::class,  
                'mapped' => false,
                'multiple'  => false,
                'expanded' => true,
                'label' => false,
                'query_builder' => function (EntityRepository $er) {
                   $query = $er->createQueryBuilder('q')
                    ->orderBy('rand()') 
                    ->setMaxResults(1)
                    ;
                  
                    return $query;
                }
            ]); */

           /*  $builder->get('question')->addEventListener(

                FormEvents::PRE_SET_DATA,
                function (FormEvent $event){
                    $form = $event->getForm();
                    $data = $event->getData();
                    dump($data);
                    $form->getParent()->add('reponse', EntityType::class, [
                        'class' => Reponse::class, 
                        'expanded' => true,
                        'label'  =>false,
                        'multiple'  => false,
                        'mapped'=> false,
                        'choices' => $form->getData(),
          
                    ]);
                }
            );     */ 
   