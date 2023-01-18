<?php

namespace App\Event;

use App\Entity\Recette;
use Symfony\Contracts\EventDispatcher\Event;

class RecetteSuccessEvent extends Event
{
    private $recette;

    public function __construct(Recette $recette)
    {
        $this->recette = $recette;
    }

    public function getRecette(): Recette
    {
        return $this->recette;
    }
}
