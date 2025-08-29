<?php

namespace App\Service;

use App\Entity\Pokemon;

class PokemonEvolutionService
{
    public function getAllEvolutions(Pokemon $pokemon): array
    {
        // Initialisation d'un tableau vide qui va contenir toutes les évolutions du Pokemon passé en paramètre
        $evolutions = [];

        // On parcourt toutes les évolutions du Pokemon
        foreach ($pokemon->getEvolutions() as $evolution) {
            // Ajoute l'évolution actuelle au tableau $evolutions
            $evolutions[] = $evolution;
            // On appelle getAllEvolutions sur l’évolution que l’on vient d’ajouter cela permet de récupérer les évolutions de l'évolution
            // array_merge permet de fusionner les tableaux pour avoir toutes les évolutions dans un seul tableau
            $evolutions = array_merge($evolutions, $this->getAllEvolutions($evolution));
        }

        return $evolutions;
    }

    public function getAllPreEvolutions(Pokemon $pokemon): array
    {
        $preEvolutions = [];

        foreach ($pokemon->getPreEvolutions() as $pre) {
            $preEvolutions[] = $pre;
            $preEvolutions = array_merge($preEvolutions, $this->getAllPreEvolutions($pre));
        }

        return $preEvolutions;
    }
}
