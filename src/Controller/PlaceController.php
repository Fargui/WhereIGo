<?php

namespace App\Controller;

use App\Service\PlaceService;
use App\Service\BackgroundService;
use App\Repository\PlaceRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PlaceController extends AbstractController
{
    private $placeRepository;
    private $backgroundService;

    public function __construct( PlaceService $placeService, PlaceRepository $placeRepository, BackgroundService $backgroundService){
        $this->placeService = $placeService;
        $this->placeRepository = $placeRepository;

        $this->backgroundService = $backgroundService;
        
    }


    /**
     * @Route("/list", name="list")
     */
    public function list()
    {   
        $places = $this->placeRepository->findAll();
        return $this->render('place/list.html.twig', [
            'places' => $places,
            'background' => $this->backgroundService->getBackgroundRandom( )
        ]);
    }

    /**
     * @Route("/list/{id}", name="show", requirements={"id"="\d+"})
     */
    public function show()
    {

        $places = $this->placeRepository->findAll();
        return $this->render( 'place/show.html.twig', array(
            'background' => $this->backgroundService->getbackgroundRandom(  ),
            'places' => $places,
        ));
    }

   
}
