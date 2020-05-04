<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReponseRepository")
 */
class Reponse
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
    private $answer;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Place", inversedBy="idReponse")
     */
    private $hideCategory;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Question", mappedBy="reponseHasQuestion")
     */
    private $idQuestion;

    public function __construct()
    {
        $this->hideCategory = new ArrayCollection();
        $this->idQuestion = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    /**
     * @return Collection|Place[]
     */
    public function getHideCategory(): Collection
    {
        return $this->hideCategory;
    }

    public function addHideCategory(Place $hideCategory): self
    {
        if (!$this->hideCategory->contains($hideCategory)) {
            $this->hideCategory[] = $hideCategory;
        }

        return $this;
    }

    public function removeHideCategory(Place $hideCategory): self
    {
        if ($this->hideCategory->contains($hideCategory)) {
            $this->hideCategory->removeElement($hideCategory);
        }

        return $this;
    }

    /**
     * @return Collection|Question[]
     */
    public function getIdQuestion(): Collection
    {
        return $this->idQuestion;
    }

    public function addIdQuestion(Question $idQuestion): self
    {
        if (!$this->idQuestion->contains($idQuestion)) {
            $this->idQuestion[] = $idQuestion;
            $idQuestion->addReponseHasQuestion($this);
        }

        return $this;
    }

    public function removeIdQuestion(Question $idQuestion): self
    {
        if ($this->idQuestion->contains($idQuestion)) {
            $this->idQuestion->removeElement($idQuestion);
            $idQuestion->removeReponseHasQuestion($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->answer;
    }
}
