<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PlaceRepository")
 */
class Place
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $address;

    /**
     * @ORM\Column(type="integer")
     */
    private $zip_code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $country;

    /**
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @ORM\Column(type="float")
     */
    private $longitude;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Picture", mappedBy="place", orphanRemoval=true)
     */
    private $pictures;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlaceHasCategory", mappedBy="place", orphanRemoval=true)
     */
    private $placeHasCategories;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CalendarHasPlace", mappedBy="place")
     */
    private $calendarHasPlaces;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="place")
     */
    private $bookings;

    /**
     * @ORM\Column(type="float")
     */
    private $price;
     /** 
     * @ORM\ManyToMany(targetEntity="App\Entity\Reponse", mappedBy="hideCategory")
     */
    private $idReponse;


    public function __construct()
    {
        $this->pictures = new ArrayCollection();
        $this->placeHasCategories = new ArrayCollection();
        $this->calendarHasPlaces = new ArrayCollection();
        $this->bookings = new ArrayCollection();
    }

    /**
     * Donne un [] des jours nons dispos
     *
     * @return array [] objets DateTime représentant les jours d'occupation
     */
    public function getNoDispoDate(){
        $noDispo = []; // Tableau qui contiendra les nuits qui ne sont pas dispos

        foreach($this->bookings as $booking){ // Du coup on boucle sur chacune des réservations

            // Calcul les jours entre départ et arrivée range()
            $result = range( // range() calcule les éléments avec les étapes à passer en fonction
                            //=> il prend en premier paramètre une date de départ, en second une date à atteindre et en 3, les étapes de calcul
                $booking->getStartAt()->getTimestamp(), // Je récupère la date d'arrivée
                $booking->getEndAt()->getTimestamp(),   // Je récupère la date de départ
                24 * 60 * 60 // les étapes de calcul pour avoir le timestamp d'une nuit rréservée
            );
            // Je crée un [] $nights avec la function array_map(transforme le [] range en un autre [] en lui donnant une function de transformation)
            $nights = array_map(function($nightTimestamp){ // une nuit mais sous forme de timeStamp
                return new \DateTime(date('Y-m-d', $nightTimestamp)); // retourne une (date (au format classique, se base sur le $timestamp qu'on a reçu
            }, $result ); // en 2eme param on lui dit sur quel tableau on fait cette transformation
            // Là on reprend notre [] d'en haut
            $noDispo = array_merge($noDispo, $nights); // array_merge(fusionne notre [] avec $nights) pendant l'avancement de la boucle, le [] $noDispo se remplis des dates reservées
        }
            return $noDispo;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getZipCode(): ?int
    {
        return $this->zip_code;
    }

    public function setZipCode(int $zip_code): self
    {
        $this->zip_code = $zip_code;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return Collection|Picture[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setPlace($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->contains($picture)) {
            $this->pictures->removeElement($picture);
            // set the owning side to null (unless already changed)
            if ($picture->getPlace() === $this) {
                $picture->setPlace(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PlaceHasCategory[]
     */
    public function getPlaceHasCategories(): Collection
    {
        return $this->placeHasCategories;
    }

    public function addPlaceHasCategory(PlaceHasCategory $placeHasCategory): self
    {
        if (!$this->placeHasCategories->contains($placeHasCategory)) {
            $this->placeHasCategories[] = $placeHasCategory;
            $placeHasCategory->setPlace($this);
        }

        return $this;
    }

    public function removePlaceHasCategory(PlaceHasCategory $placeHasCategory): self
    {
        if ($this->placeHasCategories->contains($placeHasCategory)) {
            $this->placeHasCategories->removeElement($placeHasCategory);
            // set the owning side to null (unless already changed)
            if ($placeHasCategory->getPlace() === $this) {
                $placeHasCategory->setPlace(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CalendarHasPlace[]
     */
    public function getCalendarHasPlaces(): Collection
    {
        return $this->calendarHasPlaces;
    }

    public function addCalendarHasPlace(CalendarHasPlace $calendarHasPlace): self
    {
        if (!$this->calendarHasPlaces->contains($calendarHasPlace)) {
            $this->calendarHasPlaces[] = $calendarHasPlace;
            $calendarHasPlace->setPlace($this);
        }

        return $this;
    }

    public function removeCalendarHasPlace(CalendarHasPlace $calendarHasPlace): self
    {
        if ($this->calendarHasPlaces->contains($calendarHasPlace)) {
            $this->calendarHasPlaces->removeElement($calendarHasPlace);
            // set the owning side to null (unless already changed)
            if ($calendarHasPlace->getPlace() === $this) {
                $calendarHasPlace->setPlace(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setPlace($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->contains($booking)) {
            $this->bookings->removeElement($booking);
            // set the owning side to null (unless already changed)
            if ($booking->getPlace() === $this) {
                $booking->setPlace(null);
            }
        }

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
