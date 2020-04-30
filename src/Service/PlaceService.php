<?php
namespace App\Service;

use App\Repository\PlaceRepository;

class PlaceService{

    private $placeRepository;

    public function __construct( PlaceRepository $placeRepository){
        $this->placeRepository = $placeRepository;
    }

    public function get( $id ){
        return $this->placeRepository->find( $id );
    }

    public function getRandom(){
        return $this->placeRepository->getRandom();
    }
}


