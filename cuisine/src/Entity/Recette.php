<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecetteRepository::class)
 */
class Recette
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Duree;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Difficulte;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Prix;

    /**
     * @ORM\OneToMany(targetEntity=Etape::class, mappedBy="recette")
     */
    private $etapes;

    /**
     * @ORM\OneToMany(targetEntity=IngredientRecette::class, mappedBy="recette", orphanRemoval=true)
     */
    private $ingredientRecettes;

    /**
     * @ORM\OneToMany(targetEntity=UstensileRecette::class, mappedBy="recette", orphanRemoval=true)
     */
    private $ustensileRecettes;

    public function __construct()
    {
        $this->etapes = new ArrayCollection();
        $this->ingredientRecettes = new ArrayCollection();
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

    public function getDuree(): ?int
    {
        return $this->Duree;
    }

    public function setDuree(?int $Duree): self
    {
        $this->Duree = $Duree;

        return $this;
    }

    public function getDifficulte(): ?string
    {
        return $this->Difficulte;
    }

    public function setDifficulte(?string $Difficulte): self
    {
        $this->Difficulte = $Difficulte;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->Prix;
    }

    public function setPrix(?string $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    /**
     * @return Collection<int, Etape>
     */
    public function getEtapes(): Collection
    {
        return $this->etapes;
    }

    public function addEtape(Etape $etape): self
    {
        if (!$this->etapes->contains($etape)) {
            $this->etapes[] = $etape;
            $etape->setRecette($this);
        }

        return $this;
    }

    public function removeEtape(Etape $etape): self
    {
        if ($this->etapes->removeElement($etape)) {
            // set the owning side to null (unless already changed)
            if ($etape->getRecette() === $this) {
                $etape->setRecette(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, IngredientRecette>
     */
    public function getIngredientRecettes(): Collection
    {
        return $this->ingredientRecettes;
    }

    public function addIngredientRecette(IngredientRecette $ingredientRecette): self
    {
        if (!$this->ingredientRecettes->contains($ingredientRecette)) {
            $this->ingredientRecettes[] = $ingredientRecette;
            $ingredientRecette->setRecette($this);
        }

        return $this;
    }

    public function removeIngredientRecette(IngredientRecette $ingredientRecette): self
    {
        if ($this->ingredientRecettes->removeElement($ingredientRecette)) {
            // set the owning side to null (unless already changed)
            if ($ingredientRecette->getRecette() === $this) {
                $ingredientRecette->setRecette(null);
            }
        }

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
            $ustensileRecette->setRecette($this);
        }

        return $this;
    }

    public function removeUstensileRecette(UstensileRecette $ustensileRecette): self
    {
        if ($this->ustensileRecettes->removeElement($ustensileRecette)) {
            // set the owning side to null (unless already changed)
            if ($ustensileRecette->getRecette() === $this) {
                $ustensileRecette->setRecette(null);
            }
        }

        return $this;
    }
}
