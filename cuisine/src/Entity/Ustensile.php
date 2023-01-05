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
    private $ustensileRecettes;

    public function __construct()
    {
        $this->ustensileRecettes = new ArrayCollection();
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
        return $this->ustensileRecettes;
    }

    public function addUstensileRecette(UstensileRecette $ustensileRecette): self
    {
        if (!$this->ustensileRecettes->contains($ustensileRecette)) {
            $this->ustensileRecettes[] = $ustensileRecette;
            $ustensileRecette->setUstensile($this);
        }

        return $this;
    }

    public function removeUstensileRecette(UstensileRecette $ustensileRecette): self
    {
        if ($this->ustensileRecettes->removeElement($ustensileRecette)) {
            // set the owning side to null (unless already changed)
            if ($ustensileRecette->getUstensile() === $this) {
                $ustensileRecette->setUstensile(null);
            }
        }

        return $this;
    }
}
