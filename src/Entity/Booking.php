<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Booking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $booker;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Place", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $place;

    /**
     * @ORM\Column(type="datetime")
     * 
     */
    private $startAt;

    /**
     * @ORM\Column(type="datetime")
     * 
     */
    private $endAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="float")
     */
    private $total_price;

    private $name = '';



    /**
     * Callback appelé à chaque fois qu'on créé une réservation
     * 
     * @ORM\PrePersist
     *
     * @return void
     */
    public function prePersist(){
        if(empty($this->createdAt)) {
                 $this->createdAt = new \Datetime();
        }

        if(empty($this->total_price)) {
            // prix de la place * nombre de jour
                 $this->total_price = 
                 $this->place->getPrice() * $this->getDuration();
        }
    }

    public function dispoDate(){

         // Connaitre date pas possible 
         $noDispo        = $this->place->getNoDispoDate(); // [] de nuits pas possible de résa
         // Comparaison dates choisies
         $bookingNights  = $this->getNights(); // gâce aux infos récupérées dans getNights()

            $formatNight = function($night){
            return $night->format('Y-m-d');
            }; 
            $nights  = array_map($formatNight, $bookingNights);
            $noDispo = array_map($formatNight, $noDispo);
        // -----------------------------------------------------
         //Tableau des chaines de caractères de mes journées
        // -----------------------------------------------------
        /* $nights = array_map(function($night){
            return $night->format('Y-m-d');
        }, $bookingNights);
        $noDispo = array_map(function($night){
            return $night->format('Y-m-d');
        }, $noDispo); */

        foreach($nights as $night) { 
            if(array_search($night, $noDispo) !== false) return false; // [] cherche ma résas ds [] des résas non dispos ->
        }
            return true;
    }

    /**
     * Permet de récup un [] des nights correspondantes à la résa
     *
     * @return array un [] d'obj DateTime
     */
    public function getNights() {
        $result = range(
            $this->startAt->getTimestamp(),
            $this->endAt->getTimestamp(),
            24 * 60 * 60
        );

        $nights = array_map(function($nightTimestamp){
            return new \DateTime(date('Y-m-d', $nightTimestamp));
        }, $result);

        return $nights;

    }


    public function getDuration(){
        $diff = $this->endAt->diff($this->startAt);
        return $diff->days;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBooker(): ?User
    {
        return $this->booker;
    }

    public function setBooker(?User $booker): self
    {
        $this->booker = $booker;

        return $this;
    }

    public function getPlace(): ?Place
    {
        return $this->place;
    }

    public function setPlace(?Place $place): self
    {
        $this->place = $place;

        return $this;
    }

    public function getStartAt(): ?\DateTimeInterface
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeInterface $startAt): self
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeInterface
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTimeInterface $endAt): self
    {
        $this->endAt = $endAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getTotalPrice(): ?float
    {
        return $this->total_price;
    }

    public function setTotalPrice(float $total_price): self
    {
        $this->total_price = $total_price;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }
}
