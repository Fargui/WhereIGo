<?php
namespace App\Service;

use App\Repository\PlaceRepository;
use App\Repository\QuestionRepository;

class TunnelService{

    private $questionRepository;

    public function __construct( QuestionRepository $questionRepository){
        $this->questionRepository = $questionRepository;
    }

   public function searchQuestion($data){
       return $this->questionRepository->searchQuestion($data);   
   }

   public function getQuestionRandom(){
    return $this->questionRepository->getQuestionRandom();   
}
}