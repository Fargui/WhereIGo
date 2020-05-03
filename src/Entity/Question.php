<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuestionRepository")
 */
class Question
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
    private $ask;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Reponse", inversedBy="idQuestion")
     */
    private $reponseHasQuestion;

    public function __construct()
    {
        $this->reponseHasQuestion = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAsk(): ?string
    {
        return $this->ask;
    }

    public function setAsk(string $ask): self
    {
        $this->ask = $ask;

        return $this;
    }

    /**
     * @return Collection|Reponse[]
     */
    public function getReponseHasQuestion(): Collection
    {
        return $this->reponseHasQuestion;
    }

    public function addReponseHasQuestion(Reponse $reponseHasQuestion): self
    {
        if (!$this->reponseHasQuestion->contains($reponseHasQuestion)) {
            $this->reponseHasQuestion[] = $reponseHasQuestion;
        }

        return $this;
    }

    public function removeReponseHasQuestion(Reponse $reponseHasQuestion): self
    {
        if ($this->reponseHasQuestion->contains($reponseHasQuestion)) {
            $this->reponseHasQuestion->removeElement($reponseHasQuestion);
        }

        return $this;
    }
}
