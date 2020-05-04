<?php

namespace App\Controller;

use App\Form\TunnelFormType;
use App\Service\TunnelService;
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
        $form = $this->createForm(TunnelFormType::class);
        $form->handleRequest($request);
        $question = $this->tunnelService->getQuestionRandom();
        $background = $this->backgroundService->getBackgroundRandom();
        return $this->render('home/home.html.twig', [
            'background' => $background,
            'form'       => $form->createView(),
            'question'  =>  $question,

        ]);
    }


     /*  $session = new Session;
                
                $listReponse = $session->get('listReponse', array());
                dump($session->get('listReponse', array()));
                $session->set('listReponse', $reponse);
                dump($listReponse); */
}