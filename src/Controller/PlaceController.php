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
    private $placeRepository;
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
        $form = $this->createForm(SearchFormType::class, $data);
        $form->handleRequest($request);
        // dd($data); 
        //$places = $this->placeRepository->findAll();
        $places = $this->placeRepository->findSearch($data);
        
        return $this->render('place/list.html.twig', [
            'places'     => $places,
            'form'       => $form->createView(),
            'background' => $this->backgroundService->getBackgroundRandom()
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
     * @Route("/list", name="list")
     */
/*     public function searchFilter(Request $request)
    {
        
        $data   = new SearchData();
        $places = $this->placeRepository->findSearch($data);
        $form   = $this->createForm(SearchFormType::class, $data);
        $form->handleRequest($request);

        return $this->render('place/list.html.twig', [
            'form' => $form->createView()
        ]);
    }
 */
   
}
