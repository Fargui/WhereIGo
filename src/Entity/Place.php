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
     * @ORM\ManyToMany(targetEntity="App\Entity\Reponse", mappedBy="hideCategory")
     */
    private $idReponse;


    public function __construct()
    {
        $this->pictures = new ArrayCollection();
        $this->placeHasCategories = new ArrayCollection();
        $this->calendarHasPlaces = new ArrayCollection();
        $this->idReponse = new ArrayCollection();
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
     * @return Collection|Reponse[]
     */
    public function getIdReponse(): Collection
    {
        return $this->idReponse;
    }

    public function addIdReponse(Reponse $idReponse): self
    {
        if (!$this->idReponse->contains($idReponse)) {
            $this->idReponse[] = $idReponse;
            $idReponse->addHideCategory($this);
        }

        return $this;
    }

    public function removeIdReponse(Reponse $idReponse): self
    {
        if ($this->idReponse->contains($idReponse)) {
            $this->idReponse->removeElement($idReponse);
            $idReponse->removeHideCategory($this);
        }

        return $this;
    }
}
