<?php

namespace App\Controller;

use App\Entity\Place;
use App\Entity\Booking;
use App\Form\BookingType;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class BookingController extends AbstractController
{
    /**
     * @Route("/list/{id}/booking", name="booking_create")
     *  
     */
    public function book(Place $place, Request $request, ObjectManager $manager)
    {
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);

        $form->handleRequest($request); 
        
        if($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();

            $booking->setBooker($user)
                    ->setPlace($place);

                // Si les dates non dispos, message erreur
                if (!$booking->dispoDate()) {
                        $this->addFlash(
                        'warning',
                        "dates déjà prises !"
                    );
                } else {
                $manager->persist($booking);
                $manager->flush();

                return $this->redirectToRoute('booking_show', ['id' => $booking->getId(),
                'withAlert' => true]); 
                }
   
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
     * @param Booking $booking
     * @return Response
     */
    public function show(Booking $booking){
        return $this->render('booking/show.html.twig', [
            'booking' => $booking
        ]);

    }
}
