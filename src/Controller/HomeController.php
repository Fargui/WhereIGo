<?php

namespace App\Controller;

use App\Form\TunnelFormType;
use App\Service\TunnelService;
use App\Data\TunnelData;
use App\Service\BackgroundService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController {


    private $backgroundService;
    private $tunnelService;


    public function __construct(   BackgroundService $backgroundService, TunnelService $tunnelService ){
        $this->backgroundService = $backgroundService;
        $this->tunnelService = $tunnelService;
 
    }

    /**
     * @Route("/", name="homepage")
     */
    public function home(Request $request)
    {
        $background = $this->backgroundService->getBackgroundRandom();


        $form = $this->createForm(TunnelFormType::class);
        $form->handleRequest($request);

 

        if($form->isSubmitted() && $form->isValid()){
           
            $places = $this->tunnelService->findTunnel($request);
            
            return $this->render('home/result_tunnel.html.twig', [
                'background' => $background,
                'places'     => $places,
            ]);
        }
  
        return $this->render('home/home.html.twig', [
            'background' => $background,
            'form'       => $form->createView(),
        ]);
    }



   
     /*  $session = new Session;
                
                $listReponse = $session->get('listReponse', array());
                dump($session->get('listReponse', array()));
                $session->set('listReponse', $reponse);
                dump($listReponse); */
    



}