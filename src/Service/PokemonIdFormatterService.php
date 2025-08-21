<?php

namespace App\Service;

use App\Entity\Pokemon;
use App\Repository\PokemonRepository;
use Doctrine\ORM\EntityManagerInterface;

class PokemonIdFormatterService
{
    public function format(int $id): string
    {
        return str_pad((string)$id, 4, "0", STR_PAD_LEFT);
    }
    /*
    private EntityManagerInterface $em;
    private PokemonRepository $repository;

    public function __construct(EntityManagerInterface $em, PokemonRepository $repository)
    {
        $this->em = $em;
        $this->repository = $repository;
    }

    public function formatter(string $id): string
    {
        // On cherche la donnée à modifier
        $pokemonId = $this->repository->findOneBy(['id' => $id]);

        $idFormatter = $pokemonId->getId();

        // Si sa chaine de caractère est strictement égale à 1
        if (strlen($idFormatter) === 1) {
            // On instancie un nouvel objet
            $idFormatter = new Pokemon();

            // On modifie sa valeur avec "000" devant
            $idFormatter->setPokedexId("000" . $idFormatter);
            // Sauvegarde en BDD
            $this->em->persist($idFormatter);
            $this->em->flush();

        } elseif (strlen($idFormatter) === 2) {
            $idFormatter = new Pokemon();

            $idFormatter->setPokedexId("00" . $idFormatter);
            $this->em->persist($idFormatter);
            $this->em->flush();

        } elseif (strlen($idFormatter) === 3) {
            $idFormatter = new Pokemon();

            $idFormatter->setPokedexId("0" . $idFormatter);
            $this->em->persist($idFormatter);
            $this->em->flush();
        }

        return $idFormatter;
    }
    */

}
