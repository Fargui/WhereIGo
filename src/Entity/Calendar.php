<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CalendarRepository")
 */
class Calendar
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $starts_at;

    /**
     * @ORM\Column(type="date")
     */
    private $ends_at;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CalendarHasPlace", mappedBy="calendar", orphanRemoval=true)
     */
    private $calendarHasPlaces;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserHasCalendar", mappedBy="calendar", orphanRemoval=true)
     */
    private $userHasCalendars;

    public function __construct()
    {
        $this->calendarHasPlaces = new ArrayCollection();
        $this->userHasCalendars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartsAt(): ?\DateTimeInterface
    {
        return $this->starts_at;
    }

    public function setStartsAt(\DateTimeInterface $starts_at): self
    {
        $this->starts_at = $starts_at;

        return $this;
    }

    public function getEndsAt(): ?\DateTimeInterface
    {
        return $this->ends_at;
    }

    public function setEndsAt(\DateTimeInterface $ends_at): self
    {
        $this->ends_at = $ends_at;

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
            $calendarHasPlace->setCalendar($this);
        }

        return $this;
    }

    public function removeCalendarHasPlace(CalendarHasPlace $calendarHasPlace): self
    {
        if ($this->calendarHasPlaces->contains($calendarHasPlace)) {
            $this->calendarHasPlaces->removeElement($calendarHasPlace);
            // set the owning side to null (unless already changed)
            if ($calendarHasPlace->getCalendar() === $this) {
                $calendarHasPlace->setCalendar(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|UserHasCalendar[]
     */
    public function getUserHasCalendars(): Collection
    {
        return $this->userHasCalendars;
    }

    public function addUserHasCalendar(UserHasCalendar $userHasCalendar): self
    {
        if (!$this->userHasCalendars->contains($userHasCalendar)) {
            $this->userHasCalendars[] = $userHasCalendar;
            $userHasCalendar->setCalendar($this);
        }

        return $this;
    }

    public function removeUserHasCalendar(UserHasCalendar $userHasCalendar): self
    {
        if ($this->userHasCalendars->contains($userHasCalendar)) {
            $this->userHasCalendars->removeElement($userHasCalendar);
            // set the owning side to null (unless already changed)
            if ($userHasCalendar->getCalendar() === $this) {
                $userHasCalendar->setCalendar(null);
            }
        }

        return $this;
    }
}
