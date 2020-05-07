<?php

namespace App\Controller;

use App\Form\CartType;
use App\Entity\Booking;
use App\Service\CartService;
use App\Repository\PlaceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CartController extends AbstractController
{


    /**
     * @Route("/cart/", name="cart")
     */
    public function cart(SessionInterface $session, Request $request, PlaceRepository $placeRepository)
    {
        $em      = $this->getDoctrine()->getManager();
        $booking = new Booking();

        $panier  = $session->get('panier', []);
        $total   = 0;

        foreach($panier as $booking){
            $total += $booking->getTotalPrice();
        }

        // — STRIPE -
        // ------------------------------------------------------------
        // Set your secret key. Remember to switch to your live secret key in production!
        // See your keys here: https://dashboard.stripe.com/account/apikeys

        if ($total != 0 ){

            \Stripe\Stripe::setApiKey('sk_test_hReUheRGACw1UglMSjwoNhAv00EnOZLGLS');
            $intent = \Stripe\PaymentIntent::create([

            'amount'   => intval($total) * 100,
            'currency' => 'eur',
            // Verify your integration in this guide by including this parameter
            'metadata' => ['integration_check' => 'accept_a_payment'],
            ]);
        } else {

            $intent = 0 ;
        }

        $form = $this->createForm(CartType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            foreach ($panier as $booking) {

                $user = $this->getUser();
                $booking->setBooker($user);

                $placeId = $booking->getPlace()->getId();
                $place   = $placeRepository->find($placeId);

                $booking->setPlace($place);
                $em->persist($booking);  
            }
                $em->flush();

                $session ->set('panier',array());
              
            return $this->redirectToRoute('booking_show', [
                'id' => $booking->getId()
            ]);

        } 
  
        return $this->render('booking/cart.html.twig', [

            'items'  => $panier,
            'total'  => $total,
            'intent' => $intent, 
            'form'   => $form->createView(),   
        ]);
    }

    /**
     * @Route("/list/{id}/booking/", name="booking")
     */
    public function add($id, CartService $cartService)
    {
        $cartService->add($id);
        
        return $this->render('booking.html.twig', [
            
        ]);
    }

    /**
     * @Route("/cart/remove/{id}", name="cart_remove")
     */
    public function remove ($id, CartService $cartService)
    {

        $cartService->remove($id);

        return $this->redirectToRoute('cart');

    }
}
