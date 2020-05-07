<?php
namespace App\Service;

use App\Repository\PlaceRepository;
use App\Repository\QuestionRepository;
use App\Repository\ReponseRepository;

class TunnelService{
    

    private $questionRepository;
    private $placeRepository;
    private $reponseRepository;

    public function __construct( QuestionRepository $questionRepository, PlaceRepository $placeRepository, ReponseRepository $reponseRepository){
        $this->questionRepository = $questionRepository;
        $this->placeRepository = $placeRepository;
        $this->reponseRepository = $reponseRepository;
    }

  

   public function findTunnel($data){
    return $this->placeRepository->findTunnel($data);   
}

   public function getQuestionRandom(){
    return $this->questionRepository->getQuestionRandom();   
}


}