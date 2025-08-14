<?php

namespace App\DataFixtures;

use App\Entity\Pokemon;
use App\Entity\Talent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PokemonFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $talentsList = [
            'Engrais' => 'Augmente la puissance des attaques de type Plante de 50% lorsque les PV sont inférieurs à 1/3.',
            'Brasier' => 'Augmente la puissance des attaques de type Feu de 50% lorsque les PV sont inférieurs à 1/3.',
            'Torrent' => 'Augmente la puissance des attaques de type Eau de 50% lorsque les PV sont inférieurs à 1/3.',
            'Écran Poudre' => 'Paralyse l’adversaire lorsqu’il utilise des attaques de type Plante.',
            'Statik' => 'Peut paralyser l’adversaire au contact.',
            'Paratonnerre' => 'Attire les attaques de type Électrik et augmente la Défense Spéciale.',
            'Voile Sable' => 'Augmente l’Évasion dans le sable.',
            'Absorb Eau' => 'Restaure des PV lorsqu’attaqué par une attaque de type Eau.',
            'Chlorophylle' => 'Double la Vitesse sous le soleil.',
            'Médic Nature' => 'Restaure les altérations de statut des alliés lors d’un combat en double.',
            'Regard Vif' => 'Empêche l’adversaire de baisser vos statistiques.',
            'Intimidation' => 'Diminue l’Attaque de l’adversaire à l’entrée au combat.',
            'Sable Volant' => 'Protège contre les attaques de type Sol.',
            'Isograisse' => 'Réduit les dégâts des attaques de type Normal et Combat.',
            'Joli Sourire' => 'Charm l’adversaire pour réduire ses attaques physiques.',
            'Mue' => 'Permet de guérir d’un problème de statut lors du changement de Pokémon.',
            'Agitation' => 'Augmente la vitesse mais réduit la précision.',
            'Corps Sain' => 'Restaure légèrement les PV à chaque tour.',
            'Inconscient' => 'Annule les effets de statut adverses.',
            'Essaim' => 'Augmente la puissance des attaques de type Insecte de 50% lorsque les PV sont inférieurs à 1/3.',
            'Fuite' => 'Permet de fuir automatiquement le combat contre les Pokémon sauvages.',
            'Point Poison' => 'Peut empoisonner l’adversaire au contact.',
        ];

        $talents = [];
        foreach ($talentsList as $talentName => $description) {
            $talent = new Talent();
            $talent->setName($talentName);
            $talent->setDescription($description);
            $manager->persist($talent);
            $talents[$talentName] = $talent;
        }

        $pokemons = [
            [1, 'Bulbizarre', 'Plante', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/1.png', 0.7, 6.9, 'Mâle', 'Engrais'],
            [2, 'Herbizarre', 'Plante', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/2.png', 1.0, 13.0, 'Mâle', 'Engrais'],
            [3, 'Florizarre', 'Plante', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/3.png', 2.0, 100.0, 'Femelle', 'Engrais'],
            [4, 'Salamèche', 'Feu', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/4.png', 0.6, 8.5, 'Mâle', 'Brasier'],
            [5, 'Reptincel', 'Feu', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/5.png', 1.1, 19.0, 'Mâle', 'Brasier'],
            [6, 'Dracaufeu', 'Feu', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/6.png', 1.7, 90.5, 'Femelle', 'Brasier'],
            [7, 'Carapuce', 'Eau', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/7.png', 0.5, 9.0, 'Mâle', 'Torrent'],
            [8, 'Carabaffe', 'Eau', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/8.png', 1.0, 22.5, 'Mâle', 'Torrent'],
            [9, 'Tortank', 'Eau', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/9.png', 1.6, 85.5, 'Femelle', 'Torrent'],
            [10, 'Chenipan', 'Insecte', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/10.png', 0.3, 2.9, 'Mâle', 'Écran Poudre'],
            [11, 'Chrysacier', 'Insecte', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/11.png', 0.7, 9.9, 'Mâle', 'Mue'],
            [12, 'Papilusion', 'Insecte', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/12.png', 1.1, 32.0, 'Femelle', 'Écran Poudre'],
            [13, 'Aspicot', 'Insecte', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/13.png', 0.3, 3.2, 'Mâle', 'Écran Poudre'],
            [14, 'Coconfort', 'Insecte', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/14.png', 0.6, 10.0, 'Mâle', 'Mue'],
            [15, 'Dardargnan', 'Insecte', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/15.png', 1.0, 29.5, 'Femelle', 'Essaim'],
            [16, 'Roucool', 'Normal', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/16.png', 0.3, 1.8, 'Mâle', 'Regard Vif'],
            [17, 'Roucoups', 'Normal', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/17.png', 1.1, 30.0, 'Mâle', 'Regard Vif'],
            [18, 'Roucarnage', 'Normal', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/18.png', 1.5, 39.5, 'Femelle', 'Regard Vif'],
            [19, 'Rattata', 'Normal', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/19.png', 0.3, 3.5, 'Mâle', 'Fuite'],
            [20, 'Rattatac', 'Normal', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/20.png', 0.7, 18.5, 'Femelle', 'Fuite'],
            [21, 'Piafabec', 'Normal', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/21.png', 0.3, 2.0, 'Mâle', 'Regard Vif'],
            [22, 'Rapasdepic', 'Normal', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/22.png', 1.2, 38.0, 'Femelle', 'Regard Vif'],
            [23, 'Abo', 'Poison', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/23.png', 2.0, 6.9, 'Mâle', 'Intimidation'],
            [24, 'Arbok', 'Poison', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/24.png', 3.5, 65.0, 'Femelle', 'Intimidation'],
            [25, 'Pikachu', 'Électrik', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/25.png', 0.4, 6.0, 'Mâle', 'Statik'],
            [26, 'Raichu', 'Électrik', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/26.png', 0.8, 30.0, 'Femelle', 'Statik'],
            [27, 'Sabelette', 'Sol', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/27.png', 0.6, 12.0, 'Mâle', 'Voile Sable'],
            [28, 'Sablaireau', 'Sol', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/28.png', 1.0, 29.5, 'Femelle', 'Voile Sable'],
            [29, 'Nidoran♀', 'Poison', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/29.png', 0.4, 7.0, 'Femelle', 'Point Poison'],
            [30, 'Nidorina', 'Poison', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/30.png', 0.8, 20.0, 'Femelle', 'Point Poison'],
        ];

        foreach ($pokemons as [$pokedexId, $name, $type, $imgSrc, $size, $weight, $sex, $talentName]) {
            $pokemon = new Pokemon();
            $pokemon->setName($name);
            $pokemon->setPokedexId($pokedexId);
            $pokemon->setType($type);
            $pokemon->setImgSrc($imgSrc);
            $pokemon->setSize($size);
            $pokemon->setWeight($weight);
            $pokemon->setSex($sex);
            $pokemon->setTalent($talents[$talentName]);

            $manager->persist($pokemon);
        }

        $manager->flush();
    }
}
