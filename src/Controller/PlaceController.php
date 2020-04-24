<?php

namespace App\Controller;

use App\Entity\Place;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class PlaceController extends AbstractController
{

    /**
     * @Route("/place", name="place")
     */
    public function list()
    {
        $repo = $this->getDoctrine()->getRepository(Place::class);
        $places = $repo->findAll();

        return $this->render('place/list.html.twig', [
            'places' => $places,
        ]);
    }

    /**
     * @Route("/place/{id}", name="place_show", requirements={"id"="\d+"})
     */
    public function show($id)
    {
        $repo = $this->getDoctrine()->getRepository(Place::class);

        foreach ( $this->$places as $place ){
            if ($place['id'] == $id){
            break;
            }
        }

        return $this->render('place/show.html.twig', [
            "place" => $places( $id )
        ]);
    }
}
