<?php

namespace App\DataFixtures;

use App\Entity\Pokemon;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PokemonFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $pokemons = [
            [1, 'Bulbizarre', 'Plante', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/1.png', 0.7, 6.9, 'Mâle'],
            [2, 'Herbizarre', 'Plante', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/2.png', 1.0, 13.0, 'Mâle'],
            [3, 'Florizarre', 'Plante', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/3.png', 2.0, 100.0, 'Femelle'],
            [4, 'Salamèche', 'Feu', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/4.png', 0.6, 8.5, 'Mâle'],
            [5, 'Reptincel', 'Feu', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/5.png', 1.1, 19.0, 'Mâle'],
            [6, 'Dracaufeu', 'Feu', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/6.png', 1.7, 90.5, 'Femelle'],
            [7, 'Carapuce', 'Eau', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/7.png', 0.5, 9.0, 'Mâle'],
            [8, 'Carabaffe', 'Eau', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/8.png', 1.0, 22.5, 'Mâle'],
            [9, 'Tortank', 'Eau', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/9.png', 1.6, 85.5, 'Femelle'],
        ];

        foreach ($pokemons as [$pokedexId, $name, $type, $imgSrc, $size, $weight, $sex]) {
            $pokemon = new Pokemon();
            $pokemon->setName($name);
            $pokemon->setPokedexId($pokedexId);
            $pokemon->setType($type);
            $pokemon->setImgSrc($imgSrc);
            $pokemon->setSize($size);
            $pokemon->setWeight($weight);
            $pokemon->setSex($sex);

            $manager->persist($pokemon);
        }

        $manager->flush();
    }
}
