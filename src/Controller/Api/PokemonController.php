<?php

namespace App\Controller\Api;

use App\Entity\Pokemon;
use App\Repository\PokemonRepository;
use App\Repository\TalentRepository;
use App\Repository\TypeRepository;
use App\Service\PokemonEvolutionService;
use App\Service\PokemonIdFormatterService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

final class PokemonController extends AbstractController
{
    #[Route('/api/pokemons', name: 'api_pokemon_index', methods: ['GET'])]
    public function index(PokemonRepository $repo): JsonResponse
    {
        $pokemons = $repo->findAll();

        // On mappe les entités vers un tableau "propre" (pas tout l'objet Doctrine)
        $data = array_map(function ($pokemon) {
            return [
                'id' => $pokemon->getId(),
                'name' => $pokemon->getName(),
                'pokedexId' => $pokemon->getPokedexId(),
                'imgSrc' => $pokemon->getImgSrc(),

                // Relation ManyToMany
                'types' => $pokemon->getType()->map(fn($type) => [
                    'id' => $type->getId(),
                    'name' => $type->getName(),
                    'style' => $type->getStyle(),
                ])->toArray(),
            ];
        }, $pokemons);

        return $this->json($data);
    }


    #[Route('/api/pokemons/{id}', name: 'api_pokemon_show', methods: ['GET'])]
    public function show(PokemonEvolutionService $evolutionService, Pokemon $pokemon = null): JsonResponse
    {
        if (!$pokemon) {
            return $this->json(['error' => 'Pokemon non trouvé'], 404);
        }

        // On mappe toutes les entités vers un tableau propre
        $data = [
            'id' => $pokemon->getId(),
            'name' => $pokemon->getName(),
            'pokedexId' => $pokemon->getPokedexId(),
            'description' => $pokemon->getDescription(),
            'size' => $pokemon->getSize(),
            'weight' => $pokemon->getWeight(),
            'sex' => $pokemon->getSex(),
            'imgSrc' => $pokemon->getImgSrc(),
            // Talent est une clé étrangère dans Pokemon (ManyToOne)
            'talent' => [
                'name' => $pokemon->getTalent()->getName(),
                'description' => $pokemon->getTalent()->getDescription(),
            ],
            // Type est une relation ManyToMany avec Pokemon
            'types' => $pokemon->getType()->map(fn($type) => [
                'name' => $type->getName(),
                'style' => $type->getStyle(),
            ]),
            'evolutions' => array_map(fn($p) => [
                'id' => $p->getId(),
                'name' => $p->getName(),
                'imgSrc' => $p->getImgSrc(),
            ], $evolutionService->getAllEvolutions($pokemon)),
            'preEvolutions' => array_map(fn($p) => [
                'id' => $p->getId(),
                'name' => $p->getName(),
                'imgSrc' => $p->getImgSrc(),
            ], $evolutionService->getAllPreEvolutions($pokemon)),
        ];

        return $this->json($data);
    }


    #[Route('/api/pokemon/create', name: 'api_pokemon_create', methods: ['POST'])]
    public function create(
        Request $request,
        EntityManagerInterface $em,
        TalentRepository $talentRepository,
        TypeRepository $typeRepository,
        PokemonIdFormatterService  $pokemonIdFormatterService,
    ): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        // Caster la valeur reçue en int pour mon service
        $pokedexId = $pokemonIdFormatterService->format((int) $data['pokedexId']);

        $pokemon = new Pokemon();
        $pokemon->setName($data['name']);
        $pokemon->setPokedexId($pokedexId); // setter avec la valeur formatée
        $pokemon->setSize((float) $data['size']);
        $pokemon->setWeight((float) $data['weight']);
        $pokemon->setSex($data['sex']);
        $pokemon->setImgSrc($data['imgSrc']);
        $pokemon->setDescription($data['description']);

        // On récupère le talent existant
        if (!empty($data['talentId'])) {
            $talent = $talentRepository->find($data['talentId']);
            if ($talent) {
                $pokemon->setTalent($talent); // Relation ManyToOne
            }
        }

        // On récupère les types
        if (!empty($data['typeIds'])) {
            foreach ($data['typeIds'] as $typeId) {
                $type = $typeRepository->find($typeId);
                if ($type) {
                    $pokemon->addType($type);
                }
            }
        }

        $em->persist($pokemon);
        $em->flush();

        return $this->json([
            'message' => 'Pokémon ajouté avec succès',
            'pokemon' => [
                'id' => $pokemon->getId(),
                'name' => $pokemon->getName(),
                'pokedexId' => $pokemon->getPokedexId(),
                'size' => $pokemon->getSize(),
                'weight' => $pokemon->getWeight(),
                'sex' => $pokemon->getSex(),
                'description' => $pokemon->getDescription(),
                'talent' => $pokemon->getTalent()?->getName(), // renvoie le nom du talent
            ]
        ]);
    }


    #[Route('/api/pokemons/{id}/edit', name: 'api_pokemon_update', methods: ['PATCH'])]
    public function update(Request $request, EntityManagerInterface $em, Pokemon $pokemon = null): JsonResponse
    {
        if (!$pokemon) {
            return $this->json(['error' => 'Pokemon not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        // On ne met à jour que les champs présents
        if (isset($data['name'])) {
            $name = trim((string) $data['name']);
            if ($name === '') {
                return $this->json(['error' => 'Le nom ne peut pas être vide'], 400);
            }
            $pokemon->setName($name);
        }

        $em->flush();

        return $this->json([
            'name' => $pokemon->getName(),
        ]);
    }


    #[Route('/api/pokemons/{id}', name: 'api_pokemon_delete', methods: ['DELETE'])]
    public function delete(EntityManagerInterface $em, Pokemon $pokemon = null): JsonResponse
    {
        if (!$pokemon) {
            return $this->json(['error' => 'Pokemon non trouvé'], 404);
        }

        $em->remove($pokemon);
        $em->flush();

        return $this->json(['message' => 'Pokemon deleted']);
    }
}
