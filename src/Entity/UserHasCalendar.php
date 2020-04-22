<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserHasCalendarRepository")
 */
class UserHasCalendar
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Calendar", inversedBy="userHasCalendars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $calendar;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="userHasCalendars")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $enfants;

    /**
     * @ORM\Column(type="integer")
     */
    private $adults;

    /**
     * @ORM\Column(type="integer")
     */
    private $reservation_number;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCalendar(): ?Calendar
    {
        return $this->calendar;
    }

    public function setCalendar(?Calendar $calendar): self
    {
        $this->calendar = $calendar;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getEnfants(): ?int
    {
        return $this->enfants;
    }

    public function setEnfants(int $enfants): self
    {
        $this->enfants = $enfants;

        return $this;
    }

    public function getAdults(): ?int
    {
        return $this->adults;
    }

    public function setAdults(int $adults): self
    {
        $this->adults = $adults;

        return $this;
    }

    public function getReservationNumber(): ?int
    {
        return $this->reservation_number;
    }

    public function setReservationNumber(int $reservation_number): self
    {
        $this->reservation_number = $reservation_number;

        return $this;
    }
}
