<?php

namespace App\Controller;

use App\Service\BackgroundService;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController {


    private $backgroundService;


    public function __construct(   BackgroundService $backgroundService ){
        $this->backgroundService = $backgroundService;
        // $this->request = $request;   
    }



    /**
     * @Route("/", name="homepage")
     */
    public function home()
    {
        return $this->render('home/home.html.twig', [
            'background' => $this->backgroundService->getBackgroundRandom(),
        ]);
    }
}