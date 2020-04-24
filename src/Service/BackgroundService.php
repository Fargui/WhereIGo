<?php
namespace App\Service;

use App\Repository\BackgroundRepository;

class BackgroundService{

    private $backgroundRepository;

    public function __construct( BackgroundRepository $backgroundRepository){
        $this->backgroundRepository = $backgroundRepository;
    }

   

    public function getBackgroundRandom(){
        return $this->backgroundRepository->getBackgroundRandom();
    }
    }