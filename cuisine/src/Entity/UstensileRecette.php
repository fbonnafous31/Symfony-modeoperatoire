<?php

namespace App\Entity;

use App\Repository\UstensileRecetteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UstensileRecetteRepository::class)
 */
class UstensileRecette
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Ustensile::class, inversedBy="recette")
     */
    private $ustensile;

    /**
     * @ORM\ManyToOne(targetEntity=Recette::class, inversedBy="ustensile")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recette;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUstensile(): ?Ustensile
    {
        return $this->ustensile;
    }

    public function setUstensile(?Ustensile $ustensile): self
    {
        $this->ustensile = $ustensile;

        return $this;
    }

    public function getRecette(): ?Recette
    {
        return $this->recette;
    }

    public function setRecette(?Recette $recette): self
    {
        $this->recette = $recette;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }
}
