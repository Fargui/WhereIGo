<?php
namespace App\Service;

use App\Repository\PlaceRepository;

class TunnelService{

    private $placeRepository;

    public function __construct( PlaceRepository $placeRepository){
        $this->placeRepository = $placeRepository;
    }

   public function filterBy($data){
       return $this->placeRepository->filterBy($data);   
   }
}