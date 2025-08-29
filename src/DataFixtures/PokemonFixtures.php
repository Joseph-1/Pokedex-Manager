<?php

namespace App\DataFixtures;

use App\Entity\Pokemon;
use App\Entity\Talent;
use App\Entity\Type;
use App\Service\PokemonIdFormatterService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PokemonFixtures extends Fixture
{
    // Pour utiliser le Service dans nos Fixtures, on doit obligatoirement passer par un __construct
    private PokemonIdFormatterService $formatter;

    public function __construct(PokemonIdFormatterService $formatter)
    {
        $this->formatter = $formatter;
    }

    public function load(ObjectManager $manager): void
    {
        // Relation ManyToOne avec Pokemon
        $talentsList = [
            'Engrais' => 'Augmente la puissance des attaques Plante quand les PV sont bas.',
            'Brasier' => 'Augmente la puissance des attaques Feu quand les PV sont bas.',
            'Torrent' => 'Augmente la puissance des attaques Eau quand les PV sont bas.',
            'Chlorophylle' => 'Double la Vitesse sous le soleil.',
            'Essaim' => 'Augmente la puissance des attaques Insecte quand les PV sont bas.',
            'Écran Poudre' => 'Protège des effets secondaires des attaques.',
            'Fuite' => 'Permet toujours de fuir les combats sauvages.',
            'Œil Composé' => 'Augmente la Précision.',
            'Statik' => 'Peut paralyser l’adversaire au contact.',
            'Paratonnerre' => 'Attire les attaques Électrik et augmente l’Attaque Spéciale.',
            'Joli Sourire' => 'Peut séduire l’adversaire au contact.',
            'Mue' => 'Soigne une altération de statut lors du changement de Pokémon.',
            'Corps Sain' => 'Empêche la baisse des statistiques.',
            'Attention' => 'Empêche la peur.',
            'Isograisse' => 'Réduit les dégâts Feu et Glace.',
            'Cran' => 'Augmente l’Attaque si le Pokémon subit un statut.',
            'Regard Vif' => 'Empêche la baisse de Précision.',
            'Querelleur' => 'Permet de toucher les Pokémon Spectre avec Normal et Combat.',
            'Agitation' => 'Augmente l’Attaque mais réduit la Précision.',
            'Ramassage' => 'Ramasse des objets en fin de combat.',
            'Impassible' => 'Augmente la Vitesse en cas de peur.',
            'Téméraire' => 'Augmente la puissance des attaques avec contrecoup.',
            'Point Poison' => 'Peut empoisonner l’adversaire au contact.',
            'Suintement' => 'Blesse les Pokémon qui consomment des baies.',
            'Fermeté' => 'Résiste à un coup fatal avec 1 PV.',
            'Tête de Roc' => 'Annule les dégâts de recul.',
            'Armurbaston' => 'Empêche la baisse de Défense.',
            'Voile Sable' => 'Augmente l’Esquive pendant une tempête de sable.',
            'Sable Volant' => 'Déclenche une tempête de sable en entrant.',
            'Coeur de Coq' => 'Empêche la baisse d’Attaque.',
            'Rivalité' => 'Augmente l’Attaque contre un Pokémon du même sexe.',
            'Synchro' => 'Transmet les altérations de statut.',
            'Lévitation' => 'Immunise contre les attaques Sol.',
            'Garde Magik' => 'Ne subit pas de dégâts indirects.',
            'Corps Maudit' => 'Peut désactiver une capacité ennemie en cas de contact.',
            'Rideau Neige' => 'Augmente l’Esquive pendant la grêle.',
            'Multécaille' => 'Réduit les dégâts quand les PV sont au maximum.',
            'Pression' => 'Force l’adversaire à consommer 2 PP par attaque.',
            'Esprit Vital' => 'Empêche le sommeil.',
            'Intimidation' => 'Baisse l’Attaque de l’adversaire à l’entrée.',
            'Absorb Eau' => 'Soigne lorsqu’il est touché par une attaque Eau.',
            'Absorb Volt' => 'Soigne lorsqu’il est touché par une attaque Électrik.',
            'Absorb Feu' => 'Soigne lorsqu’il est touché par une attaque Feu.',
            'Peau Dure' => 'Inflige des dégâts au contact.',
            'Champi' => 'Augmente la puissance des attaques Plante quand le Pokémon est empoisonné.',
            'Synchronisation' => 'Transmet les altérations de statut adverses au Pokémon ayant cette capacité.',
            'Insomnia' => "Empêche le Pokémon de s'endormir.",
            'Coque Armure' => "Empêche les coups critiques de toucher le Pokémon.",
            'Joli Pied' => 'Réduit l’effet des attaques de contact sur le Pokémon.',
            'Glissade' => 'Augmente la vitesse du Pokémon lorsqu’il est touché par des attaques de type Glace.',
            'Synchronie' => 'Transmet les altérations de statut subies au Pokémon adverse en cas de paralysie, brûlure ou poison.',
            'Mutualiste' => 'Lorsque le Pokémon utilise un objet tenu, les alliés en profitent également.',
            'Adaptabilité' => 'Augmente la puissance des attaques du même type que le Pokémon.',
            'Télécharge' => 'Augmente l’Attaque ou l’Attaque Spéciale en fonction du type de l’adversaire.',
        ];

        // Relation ManyToOne avec Pokemon
        $talents = [];
        foreach ($talentsList as $talentName => $description) {
            $talent = new Talent();
            $talent->setName($talentName);
            $talent->setDescription($description);
            $manager->persist($talent);
            $talents[$talentName] = $talent;
        }

        $typesList = [
            'Normal' =>   "bg-[#a8a878] text-black px-4 py-1 rounded text-sm font-light",
            'Feu' =>     "bg-[#f08030] text-white px-4 py-1 rounded text-sm font-light",
            'Eau' =>    "bg-[#6890f0] text-white px-4 py-1 rounded text-sm font-light",
            'Électrik' => "bg-[#f8d030] text-black px-4 py-1 rounded text-sm font-light",
            'Plante' =>   "bg-[#78c850] text-black px-4 py-1 rounded text-sm font-light",
            'Glace' =>      "bg-[#98d8d8] text-black px-4 py-1 rounded text-sm font-light",
            'Combat' => "bg-[#c03028] text-white px-4 py-1 rounded text-sm font-light",
            'Poison' =>   "bg-[#a040a0] text-white px-4 py-1 rounded text-sm font-light",
            'Sol' =>   "bg-[#e0c068] text-black px-4 py-1 rounded text-sm font-light",
            'Vol' =>   "bg-[#a890f0] text-black px-4 py-1 rounded text-sm font-light",
            'Psy' =>  "bg-[#f85888] text-white px-4 py-1 rounded text-sm font-light",
            'Insecte' =>      "bg-[#a8b820] text-black px-4 py-1 rounded text-sm font-light",
            'Roche' =>     "bg-[#b8a038] text-white px-4 py-1 rounded text-sm font-light",
            'Spectre' =>    "bg-[#705898] text-white px-4 py-1 rounded text-sm font-light",
            'Dragon' =>   "bg-[#7038f8] text-white px-4 py-1 rounded text-sm font-light",
            'Fée' => "bg-[#ee99ac] text-black px-4 py-1 rounded text-sm font-light",
            'Acier' => "bg-[#b8b8d0] text-black px-4 py-1 rounded text-sm font-light",
        ];

        $types = [];
        foreach ($typesList as $typeName => $style) {
            $type = new Type();
            $type->setName($typeName);
            $type->setStyle($style);
            $manager->persist($type);
            $types[$typeName] = $type;
        }

        $pokemonsData = [
            [1, 'Bulbizarre', 'Au début de sa vie, il se nourrit des nutriments accumulés dans la graine sur son dos. Cela lui permet de grandir. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/1.png', 0.7, 6.9, 'Mâle', 'Engrais', ['Plante', 'Poison'], ['Herbizarre']],
            [2, 'Herbizarre', 'Plus il s’expose au soleil, plus il emmagasine d’énergie, ce qui permet au bourgeon sur son dos de se développer.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/2.png', 1.0, 13.0, 'Mâle', 'Engrais', ['Plante', 'Poison'], ['Florizarre']],
            [3, 'Florizarre', ' Ce Pokémon est capable de transformer la lumière du soleil en énergie. Il est donc encore plus fort en été. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/3.png', 2.0, 100.0, 'Femelle', 'Engrais', ['Plante', 'Poison'], []],

        ];

        $pokemons = [];

        // Premier passage : création de tous les objets
        foreach ($pokemonsData as [$pokedexId, $name, $description, $imgSrc, $size, $weight, $sex, $talentName, $typeNames]) {
            $pokemon = new Pokemon();
            $pokemon->setName($name);
            $pokemon->setDescription($description);
            $pokemon->setPokedexId($this->formatter->format($pokedexId));
            $pokemon->setImgSrc($imgSrc);
            $pokemon->setSize($size);
            $pokemon->setWeight($weight);
            $pokemon->setSex($sex);
            $pokemon->setTalent($talents[$talentName]);

            // Relation ManyToMany avec Pokemon
            foreach ($typeNames as $typeName) {
                $pokemon->addType($types[$typeName]);
            }

            $manager->persist($pokemon);

            // On stocke dans un tableau associatif
            $pokemons[$name] = $pokemon;
        }

        // Deuxième passage : lier les évolutions
        foreach ($pokemonsData as [$pokedexId, $name, $description, $imgSrc, $size, $weight, $sex, $talentName, $typeNames, $evolutions]) {
            $pokemon = $pokemons[$name];
            foreach ($evolutions as $evolutionName) {
                $pokemon->addEvolution($pokemons[$evolutionName]);
            }
        }

        $manager->flush();
    }
}
