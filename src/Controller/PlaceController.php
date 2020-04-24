<?php

namespace App\Controller;

use App\Repository\PictureRepository;
use App\Service\PlaceService;
use App\Repository\PlaceRepository;
use App\Service\PictureService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PlaceController extends AbstractController
{

    private $placeService;
    private $placeRepository;

 
    private $pictureService;

    public function __construct( PlaceService $placeService, PlaceRepository $placeRepository, PictureService $pictureService){
        $this->placeService = $placeService;
        $this->placeRepository = $placeRepository;

        $this->pictureService = $pictureService;
        
    }


    /**
     * @Route("/list", name="list")
     */
    public function list()
    {
        $places = $this->placeRepository->findAll();

        return $this->render('place/list.html.twig', [
            'places' => $places,
            'randPhotos' => $this->placeService->getRandom()
        ]);
    }

    /**
     * @Route("/list/{id}", name="show", requirements={"id"="\d+"})
     */
    public function show(  )
    {
        return $this->render( 'place/show.html.twig', array(
            'place' => $this->pictureService->getPictureRandom(  ),
        ));
    }

   
}
