<?php

namespace App\Controller;

use App\Entity\Place;
use App\Entity\Booking;
use App\Form\BookingType;
use App\Service\CartService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class BookingController extends AbstractController
{

    /**
     * @Route("/list/{id}/booking", name="booking_create")
     * @IsGranted("ROLE_USER")
     */
    public function book(Place $place, Request $request, CartService $cartService)
    {
        
        $booking = new Booking();
        $form    = $this->createForm(BookingType::class, $booking);
        
        $form->handleRequest($request); 
        
        if($form->isSubmitted() && $form->isValid()) {

            $user = $this->getUser();

            $booking->setBooker($user)
                    ->setPlace($place)->prePersist();

            $cartService->add($booking);

            return $this->redirectToRoute('cart');
        }
        return $this->render('booking/book.html.twig', [
            
            'place' => $place,
            'form'  => $form->createView()
        ]);
    }

    /**
     * Permet d'afficher la page d'une résa
     *
     * @Route("/booking/{id}", name="booking_show")
     *
     */
    public function show(Booking $booking){
        return $this->render('booking/show.html.twig', [
            'booking' => $booking
        ]);

    }
}
