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

        $data = new TunnelData;
        $form = $this->createForm(TunnelFormType::class, $data);
        $form->handleRequest($request);
        dump($form->getData());

        $places = $this->tunnelService->findTunnel($data);

        if($form->isSubmitted() && $form->isValid()){
           
            
            $this->addFlash( 'success', "Voici le wig de vos reves" );
            return $this->render('home/result_tunnel.html.twig', [
                'background' => $background,
                'data'       => $data->reponse_,
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