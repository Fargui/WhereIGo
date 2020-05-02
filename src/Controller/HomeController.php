<?php

namespace App\Controller;

use App\Data\TunnelData;
use App\Form\TunnelFormType;
use App\Service\BackgroundService;
use Symfony\Component\HttpFoundation\Request;
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
    public function home(Request $request)
    {
        $data = new TunnelData;
        $form = $this->createForm(TunnelFormType::class, $data);
        $form->handleRequest($request);

        return $this->render('home/home.html.twig', [
            'background' => $this->backgroundService->getBackgroundRandom(),
            'form'       => $form->createView(),
        ]);
    }
}