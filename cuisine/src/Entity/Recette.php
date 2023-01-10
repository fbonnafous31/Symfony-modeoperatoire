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
    private $nom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $duree;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $difficulte;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prix;

    /**
     * @ORM\OneToMany(targetEntity=Etape::class, mappedBy="recette", cascade={"persist"})
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

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="recettes")
     */
    private $user;

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

    public function getnom(): ?string
    {
        return $this->nom;
    }

    public function setnom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getduree(): ?int
    {
        return $this->duree;
    }

    public function setduree(?int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getdifficulte(): ?string
    {
        return $this->difficulte;
    }

    public function setdifficulte(?string $difficulte): self
    {
        $this->difficulte = $difficulte;

        return $this;
    }

    public function getprix(): ?string
    {
        return $this->prix;
    }

    public function setprix(?string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
