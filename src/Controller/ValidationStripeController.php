<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ValidationStripeController extends AbstractController
{
    /**
     * @Route("/validation/stripe", name="validation_stripe")
     */
    public function stripe()
    {
        \Stripe\Stripe::setApiKey('sk_test_hReUheRGACw1UglMSjwoNhAv00EnOZLGLS');

        $payload = @file_get_contents('php://input');
        $event = null;

        try {
            $event = \Stripe\Event::constructFrom(
                json_decode($payload, true)
            );
        } catch(\UnexpectedValueException $e) {
            // Invalid payload
            http_response_code(400);
            exit();
        }

        // Handle the event
        switch ($event->type) {
            case 'payment_intent.succeeded':

                break;
            case 'payment_method.attached':

                break;
            // ... handle other event types
            default:
                // Unexpected event type
                http_response_code(400);
                exit();
        }

        http_response_code(200);

        return new Response('success');
        
    }
}
