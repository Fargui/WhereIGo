<?php

namespace App\Controller;

use App\Data\SearchData;
use App\Form\SearchFormType;
use App\Service\PlaceService;
use App\Service\BackgroundService;
use App\Repository\PlaceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlaceController extends AbstractController
{

    private $backgroundService;


    public function __construct( PlaceService $placeService, PlaceRepository $placeRepository, BackgroundService $backgroundService ){
        $this->placeService      = $placeService;
        $this->placeRepository   = $placeRepository;
        $this->backgroundService = $backgroundService;
        // $this->request = $request;
        
    }


    /**
     * @Route("/list", name="list")
     */
    public function list(Request $request)
    {
        $data = new SearchData();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(SearchFormType::class, $data);
        $form->handleRequest($request);
        $places = $this->placeService->findSearch($data);
        $background = $this->backgroundService->getBackgroundRandom();
        dump($data);
        
        return $this->render('place/list.html.twig', [
            'places'     => $places,
            'form'       => $form->createView(),
            'data'       => $data->placeHasCategories, // Represente les category cochées et envoyé au via form
            'background' => $background,
        ]);
    }


    /**
     * @Route("/list/{id}", name="show", requirements={"id"="\d+"})
     */
    public function show($id)
    {

        
        return $this->render( 'place/show.html.twig', array(
            'background' => $this->backgroundService->getbackgroundRandom(  ),
            'place' => $this->placeService->get( $id ),
        ));
    }

    /**
     * @Route("/map", name="map")
     */
    public function map()
    {
        $places = $this->placeService->allPlace();
        
        return $this->render('place/map.html.twig', [
            'places'     => $places,
            'background' => $this->backgroundService->getBackgroundRandom(),
        ]);
    }

   
}
