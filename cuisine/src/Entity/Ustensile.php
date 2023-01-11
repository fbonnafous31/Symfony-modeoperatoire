<?php

namespace App\Entity;

use App\Repository\UstensileRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UstensileRepository::class)
 */
class Ustensile
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\OneToMany(targetEntity=UstensileRecette::class, mappedBy="ustensile")
     */
    private $recette;

    public function __construct()
    {
        $this->recette = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    /**
     * @return Collection<int, UstensileRecette>
     */
    public function getUstensileRecettes(): Collection
    {
        return $this->recette;
    }

    public function addUstensileRecette(UstensileRecette $ustensile): self
    {
        if (!$this->recette->contains($ustensile)) {
            $this->recette[] = $ustensile;
            $ustensile->setUstensile($this);
        }

        return $this;
    }

    public function removeUstensileRecette(UstensileRecette $ustensile): self
    {
        if ($this->recette->removeElement($ustensile)) {
            // set the owning side to null (unless already changed)
            if ($ustensile->getUstensile() === $this) {
                $ustensile->setUstensile(null);
            }
        }

        return $this;
    }
}
