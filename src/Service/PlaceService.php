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

    public function findSearch($data){
        return $this->placeRepository->findSearch($data);
    }
<<<<<<< HEAD
    
=======

    public function allPlace(){
        return $this->placeRepository->allPlace();
    }
>>>>>>> 4169ba6abc8b63ed50867c57a50d6bcee647995b
}
