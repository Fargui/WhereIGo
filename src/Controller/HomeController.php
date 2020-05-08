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
        

        

        if($form->isSubmitted() && $form->isValid()){
           
            $reponse_1 = $request->query->get('reponse_1');
            $reponse_2 = $request->query->get('reponse_2');
            $reponse_3 = $request->query->get('reponse_3');
            $reponse_4 = $request->query->get('reponse_4');

            $places = $this->tunnelService->findTunnel($reponse_1, $reponse_2, $reponse_3, $reponse_4);

            $this->addFlash( 'success', "Voici le wig de vos reves" );
            return $this->render('home/result_tunnel.html.twig', [
                'background' => $background,
                'places'     => $places,
                'form'       => $form,
                'data'       => $data,
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