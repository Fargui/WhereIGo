<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $icon;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PlaceHasCategory", mappedBy="category")
     */
    private $placeHasCategories;

    public function __construct()
    {
        $this->placeHasCategories = new ArrayCollection();
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

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

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
            $placeHasCategory->setCategory($this);
        }

        return $this;
    }

    public function removePlaceHasCategory(PlaceHasCategory $placeHasCategory): self
    {
        if ($this->placeHasCategories->contains($placeHasCategory)) {
            $this->placeHasCategories->removeElement($placeHasCategory);
            // set the owning side to null (unless already changed)
            if ($placeHasCategory->getCategory() === $this) {
                $placeHasCategory->setCategory(null);
            }
        }

        return $this;
    }
}
