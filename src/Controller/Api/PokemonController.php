<?php

namespace App\Controller\Api;

use App\Entity\Pokemon;
use App\Repository\PokemonRepository;
use App\Repository\TalentRepository;
use App\Repository\TypeRepository;
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
    public function show(Pokemon $pokemon = null): JsonResponse
    {
        if (!$pokemon) {
            return $this->json(['error' => 'Pokemon non trouvé'], 404);
        }

        // On mappe toutes les entités vers un tableau propre
        $data = [
            'id' => $pokemon->getId(),
            'name' => $pokemon->getName(),
            'pokedexId' => $pokemon->getPokedexId(),
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
            ])
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
                'talent' => $pokemon->getTalent()?->getName(), // renvoie le nom du talent
            ]
        ]);
    }


    #[Route('/api/pokemons/{id}', name: 'api_pokemon_update', methods: ['PUT'])]
    public function update(Request $request, EntityManagerInterface $em, Pokemon $pokemon = null): JsonResponse
    {
        if (!$pokemon) {
            return $this->json(['error' => 'Pokemon not found'], 404);
        }

        $data = json_decode($request->getContent(), true);

        $pokemon->setName($data['name'] ?? $pokemon->getName());
        $pokemon->setPokedexId($data['pokedexId'] ?? $pokemon->getPokedexId());
        $pokemon->setSize($data['size'] ?? $pokemon->getSize());
        $pokemon->setWeight($data['weight'] ?? $pokemon->getWeight());
        $pokemon->setSex($data['sex'] ?? $pokemon->getSex());
        $pokemon->setImgSrc($data['imgSrc'] ?? $pokemon->getImgSrc());

        $em->flush();

        return $this->json(['message' => 'Pokemon updated']);
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
