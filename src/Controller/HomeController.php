<?php

namespace App\Controller;

use App\Form\TunnelFormType;
use App\Service\TunnelService;
use App\Data\SearchData;
use App\Form\SearchFormType;
use App\Service\BackgroundService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;

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

<<<<<<< HEAD

     /*  $session = new Session;
                
                $listReponse = $session->get('listReponse', array());
                dump($session->get('listReponse', array()));
                $session->set('listReponse', $reponse);
                dump($listReponse); */
=======
    



>>>>>>> 4169ba6abc8b63ed50867c57a50d6bcee647995b
}