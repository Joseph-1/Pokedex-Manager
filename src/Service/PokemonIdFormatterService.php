<?php

namespace App\Service;

use App\Entity\Pokemon;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;

class PokemonIdFormatterService
{
    public function format($id): string
    {
        return str_pad((string) $id, 4, "0", STR_PAD_LEFT);
    }
}
