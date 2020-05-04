<?php
namespace App\Service;


use App\Repository\QuestionRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class TunnelService{
    

    private $questionRepository;
    private $session;

    public function __construct( QuestionRepository $questionRepository, SessionInterface $session){
        $this->questionRepository = $questionRepository;
        $this->session = $session;
    }

   public function searchQuestion($data){
       return $this->questionRepository->searchQuestion($data);   
   }

   public function getQuestionRandom(){
    return $this->questionRepository->getQuestionRandom();   
}
}