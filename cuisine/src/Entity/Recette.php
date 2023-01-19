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
     * @ORM\OneToMany(targetEntity=Etape::class, cascade={"persist"}, mappedBy="recette")
     */
    private $etapes;

    /**
     * @ORM\OneToMany(targetEntity=IngredientRecette::class, mappedBy="recette")
     * @var Collection<IngredientRecette>
     */
    private $ingredient;

    /**
     * @ORM\OneToMany(targetEntity=UstensileRecette::class, mappedBy="recette", orphanRemoval=true)
     * @var Collection<UstensileRecette>
     */
    private $ustensile;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="recettes")
     */
    private $user;

    public function __construct()
    {
        $this->etapes       = new ArrayCollection();
        $this->ingredient   = new ArrayCollection();
        $this->ustensile    = new ArrayCollection();
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
    public function getIngredients(): Collection
    {
        return $this->ingredient;
    }

    public function addIngredient(IngredientRecette $ingredient): self
    {
        if (!$this->ingredient->contains($ingredient)) {
            $this->ingredient[] = $ingredient;
            $ingredient->setRecette($this);
        }

        return $this;
    }

    public function removeIngredient(IngredientRecette $ingredient): self
    {
        if ($this->ingredient->removeElement($ingredient)) {
            // set the owning side to null (unless already changed)
            if ($ingredient->getRecette() === $this) {
                $ingredient->setRecette(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UstensileRecette>
     */
    public function getUstensiles(): Collection
    {
        return $this->ustensile;
    }

    public function addUstensile(UstensileRecette $ustensile): self
    {
        if (!$this->ustensile->contains($ustensile)) {
            $this->ustensile[] = $ustensile;
            $ustensile->setRecette($this);
        }

        return $this;
    }

    public function removeUstensileRecette(UstensileRecette $ustensile): self
    {
        if ($this->ustensile->removeElement($ustensile)) {
            // set the owning side to null (unless already changed)
            if ($ustensile->getRecette() === $this) {
                $ustensile->setRecette(null);
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
