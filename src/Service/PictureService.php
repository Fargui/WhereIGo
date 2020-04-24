<?php
namespace App\Service;

use App\Repository\PictureRepository;

class PictureService{

    private $placeRepository;

    public function __construct( PictureRepository $pictureRepository){
        $this->pictureRepository = $pictureRepository;
    }

    public function get( $id ){
        return $this->pictureRepository->find( $id );
    }

    public function getPictureRandom(){
        return $this->pictureRepository->getPictureRandom();
    }
    }