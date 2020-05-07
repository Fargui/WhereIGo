<?php

namespace App\Service;

use App\Entity\Booking;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService {

    protected $session;

    public function __construct(SessionInterface $session){
        $this->session = $session;
    }

    public function add(Booking $booking){

        $panier   = $this->session->get('panier', []);
        $panier[] = $booking;
 
        $this->session->set('panier', $panier);
    }

    public function remove($id){

        $panier = $this->session->get('panier', []);
        $sorted = array_values($panier);

        if(!empty($sorted[$id-1])){
            unset($sorted[$id-1]);  
        }
        
        $this->session->set('panier', $sorted);
    }


}