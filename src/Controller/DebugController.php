<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Service\PokemonEvolutionService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DebugController extends AbstractController
{
    private PokemonEvolutionService $evolutionService;
    private ManagerRegistry $doctrine;

    public function __construct(PokemonEvolutionService $evolutionService, ManagerRegistry $doctrine)
    {
        $this->evolutionService = $evolutionService;
        $this->doctrine = $doctrine;
    }

    #[Route('/debug/pokemon/{id}', name: 'debug_pokemon')]
    public function debugPokemon(int $id): Response
    {
        $pokemon = $this->doctrine->getRepository(Pokemon::class)->find($id);

        if (!$pokemon) {
            return new Response('Pokémon non trouvé', 404);
        }

        // $allEvolutions = $this->evolutionService->getAllEvolutions($pokemon);
        // dd($allEvolutions);

        // $allPreEvolutions = $this->evolutionService->getAllPreEvolutions($pokemon);
        // dd($allPreEvolutions);

        return new Response();
    }
}
