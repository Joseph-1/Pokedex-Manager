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

        $pokemons = [
            [1, 'Bulbizarre', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/1.png', 0.7, 6.9, 'Mâle', 'Engrais', ['Plante', 'Poison']],
            [2, 'Herbizarre', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/2.png', 1.0, 13.0, 'Mâle', 'Engrais', ['Plante', 'Poison']],
            [3, 'Florizarre', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/3.png', 2.0, 100.0, 'Femelle', 'Engrais', ['Plante', 'Poison']],
            [4, 'Salamèche', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/4.png', 0.6, 8.5, 'Mâle', 'Brasier', ['Feu']],
            [5, 'Reptincel', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/5.png', 1.1, 19.0, 'Mâle', 'Brasier', ['Feu']],
            [6, 'Dracaufeu', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/6.png', 1.7, 90.5, 'Femelle', 'Brasier', ['Feu', 'Vol']],
            [7, 'Carapuce', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/7.png', 0.5, 9.0, 'Mâle', 'Torrent', ['Eau']],
            [8, 'Carabaffe', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/8.png', 1.0, 22.5, 'Mâle', 'Torrent', ['Eau']],
            [9, 'Tortank', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/9.png', 1.6, 85.5, 'Femelle', 'Torrent', ['Eau']],
            [10, 'Chenipan', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/10.png', 0.3, 2.9, 'Mâle', 'Écran Poudre', ['Insecte']],
            [11, 'Chrysacier', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/11.png', 0.7, 9.9, 'Mâle', 'Mue', ['Insecte']],
            [12, 'Papilusion', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/12.png', 1.1, 32.0, 'Femelle', 'Écran Poudre', ['Insecte', 'Vol']],
            [13, 'Aspicot', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/13.png', 0.3, 3.2, 'Mâle', 'Écran Poudre', ['Insecte', 'Poison']],
            [14, 'Coconfort', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/14.png', 0.6, 10.0, 'Mâle', 'Mue', ['Insecte', 'Poison']],
            [15, 'Dardargnan', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/15.png', 1.0, 29.5, 'Femelle', 'Essaim', ['Insecte', 'Vol']],
            [16, 'Roucool', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/16.png', 0.3, 1.8, 'Mâle', 'Regard Vif', ['Normal', 'Vol']],
            [17, 'Roucoups', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/17.png', 1.1, 30.0, 'Mâle', 'Regard Vif', ['Normal', 'Vol']],
            [18, 'Roucarnage', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/18.png', 1.5, 39.5, 'Femelle', 'Regard Vif', ['Normal', 'Vol']],
            [19, 'Rattata', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/19.png', 0.3, 3.5, 'Mâle', 'Fuite', ['Normal']],
            [20, 'Rattatac', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/20.png', 0.7, 18.5, 'Femelle', 'Fuite', ['Normal']],
            [21, 'Piafabec', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/21.png', 0.3, 2.0, 'Mâle', 'Regard Vif', ['Normal', 'Vol']],
            [22, 'Rapasdepic', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/22.png', 1.2, 38.0, 'Femelle', 'Regard Vif', ['Normal', 'Vol']],
            [23, 'Abo', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/23.png', 2.0, 6.9, 'Mâle', 'Intimidation', ['Poison']],
            [24, 'Arbok', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/24.png', 3.5, 65.0, 'Femelle', 'Intimidation', ['Poison']],
            [25, 'Pikachu', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/25.png', 0.4, 6.0, 'Mâle', 'Statik', ['Électrik']],
            [26, 'Raichu', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/26.png', 0.8, 30.0, 'Femelle', 'Statik', ['Électrik']],
            [27, 'Sabelette', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/27.png', 0.6, 12.0, 'Mâle', 'Voile Sable', ['Sol']],
            [28, 'Sablaireau', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/28.png', 1.0, 29.5, 'Femelle', 'Voile Sable', ['Sol']],
            [29, 'Nidoran♀', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/29.png', 0.4, 7.0, 'Femelle', 'Point Poison', ['Poison']],
            [30, 'Nidorina', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/30.png', 0.8, 20.0, 'Femelle', 'Point Poison', ['Poison']],
            [31, 'Nidoran♂', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/31.png', 0.5, 9.0, 'Mâle', 'Point Poison', ['Poison']],
            [32, 'Nidorino', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/32.png', 0.9, 19.5, 'Mâle', 'Point Poison', ['Poison']],
            [33, 'Nidoking', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/34.png', 1.4, 62.0, 'Mâle', 'Point Poison', ['Poison', 'Sol']],
            [34, 'Mélofée', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/35.png', 0.6, 7.5, 'Femelle', 'Joli Sourire', ['Fée']],
            [35, 'Mélodelfe', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/36.png', 1.0, 40.0, 'Femelle', 'Joli Sourire', ['Fée']],
            [36, 'Goupix', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/37.png', 0.6, 9.9, 'Mâle', 'Brasier', ['Feu']],
            [37, 'Feunard', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/38.png', 1.1, 19.9, 'Mâle', 'Brasier', ['Feu']],
            [38, 'Rondoudou', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/39.png', 0.5, 5.5, 'Femelle', 'Joli Sourire', ['Normal', 'Fée']],
            [39, 'Grodoudou', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/40.png', 1.2, 40.0, 'Femelle', 'Joli Sourire', ['Normal', 'Fée']],
            [40, 'Nosferapti', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/41.png', 0.8, 7.5, 'Mâle', 'Lévitation', ['Poison', 'Vol']],
            [41, 'Nosferalto', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/42.png', 1.6, 55.0, 'Mâle', 'Lévitation', ['Poison', 'Vol']],
            [42, 'Mystherbe', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/43.png', 0.7, 5.4, 'Mâle', 'Chlorophylle', ['Plante', 'Poison']],
            [43, 'Ortide', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/44.png', 1.0, 12.5, 'Femelle', 'Chlorophylle', ['Plante', 'Poison']],
            [44, 'Rafflesia', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/45.png', 1.2, 29.5, 'Femelle', 'Chlorophylle', ['Plante', 'Poison']],
            [45, 'Paras', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/46.png', 0.3, 5.4, 'Mâle', 'Champi', ['Insecte', 'Plante']],
            [46, 'Parasect', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/47.png', 1.0, 29.5, 'Mâle', 'Champi', ['Insecte', 'Plante']],
            [47, 'Mimitoss', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/48.png', 0.3, 3.5, 'Mâle', 'Écran Poudre', ['Insecte', 'Poison']],
            [48, 'Aéromite', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/49.png', 1.2, 32.8, 'Mâle', 'Écran Poudre', ['Insecte', 'Poison']],
            [49, 'Taupiqueur', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/50.png', 0.8, 5.0, 'Mâle', 'Voile Sable', ['Sol']],
            [50, 'Triopikeur', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/51.png', 1.1, 32.5, 'Mâle', 'Voile Sable', ['Sol']],
            [51, 'Miaouss', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/52.png', 0.4, 4.2, 'Mâle', 'Ramassage', ['Normal']],
            [52, 'Persian', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/53.png', 1.0, 32.0, 'Mâle', 'Ramassage', ['Normal']],
            [53, 'Psykokwak', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/54.png', 0.8, 19.6, 'Mâle', 'Torrent', ['Eau']],
            [54, 'Akwakwak', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/55.png', 1.6, 76.6, 'Mâle', 'Torrent', ['Eau']],
            [55, 'Férosinge', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/56.png', 0.5, 30.0, 'Mâle', 'Agitation', ['Combat']],
            [56, 'Colossinge', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/57.png', 1.8, 52.0, 'Mâle', 'Agitation', ['Combat']],
            [57, 'Caninos', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/58.png', 0.7, 19.0, 'Mâle', 'Brasier', ['Feu']],
            [58, 'Arcanin', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/59.png', 1.9, 155.0, 'Mâle', 'Brasier', ['Feu']],
            [59, 'Ptitard', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/60.png', 0.4, 9.0, 'Mâle', 'Torrent', ['Eau']],
            [60, 'Têtarte', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/61.png', 0.8, 22.0, 'Mâle', 'Torrent', ['Eau']],
            [61, 'Tartard', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/62.png', 1.6, 55.0, 'Mâle', 'Torrent', ['Eau', 'Combat']],
            [62, 'Abra', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/63.png', 0.9, 19.5, 'Mâle', 'Synchro', ['Psy']],
            [63, 'Kadabra', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/64.png', 1.3, 56.5, 'Mâle', 'Synchro', ['Psy']],
            [64, 'Alakazam', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/65.png', 1.5, 48.0, 'Mâle', 'Synchronisation', ['Psy']],
            [65, 'Machoc', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/66.png', 0.8, 19.5, 'Mâle', 'Agitation', ['Combat']],
            [66, 'Machopeur', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/67.png', 1.5, 70.5, 'Mâle', 'Agitation', ['Combat']],
            [67, 'Mackogneur', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/68.png', 1.6, 130.0, 'Mâle', 'Agitation', ['Combat']],
            [68, 'Chétiflor', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/69.png', 0.4, 2.2, 'Mâle', 'Engrais', ['Plante', 'Poison']],
            [69, 'Boustiflor', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/70.png', 0.7, 4.0, 'Mâle', 'Engrais', ['Plante', 'Poison']],
            [70, 'Empiflor', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/71.png', 1.0, 15.5, 'Mâle', 'Engrais', ['Plante', 'Poison']],
            [71, 'Tentacool', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/72.png', 0.9, 45.5, 'Mâle', 'Absorb Eau', ['Eau', 'Poison']],
            [72, 'Tentacruel', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/73.png', 1.6, 55.0, 'Mâle', 'Absorb Eau', ['Eau', 'Poison']],
            [73, 'Racaillou', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/74.png', 0.4, 20.0, 'Mâle', 'Fermeté', ['Roche', 'Sol']],
            [74, 'Gravalanch', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/75.png', 1.0, 105.0, 'Mâle', 'Fermeté', ['Roche', 'Sol']],
            [75, 'Grolem', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/76.png', 1.4, 300.0, 'Mâle', 'Fermeté', ['Roche', 'Sol']],
            [76, 'Ponyta', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/77.png', 1.0, 30.0, 'Mâle', 'Brasier', ['Feu']],
            [77, 'Galopa', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/78.png', 1.7, 95.0, 'Mâle', 'Brasier', ['Feu']],
            [78, 'Ramoloss', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/79.png', 1.2, 36.0, 'Mâle', 'Absorb Eau', ['Eau', 'Psy']],
            [79, 'Flagadoss', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/80.png', 1.5, 78.5, 'Mâle', 'Absorb Eau', ['Eau', 'Psy']],
            [80, 'Magnéti', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/81.png', 0.3, 6.0, 'Mâle', 'Statik', ['Électrik', 'Acier']],
            [81, 'Magnéton', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/82.png', 0.9, 60.0, 'Mâle', 'Statik', ['Électrik', 'Acier']],
            [82, 'Canarticho', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/83.png', 1.1, 20.0, 'Mâle', 'Intimidation', ['Normal', 'Vol']],
            [83, 'Doduo', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/84.png', 1.4, 39.2, 'Mâle', 'Fuite', ['Normal', 'Vol']],
            [84, 'Dodrio', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/85.png', 1.8, 85.2, 'Mâle', 'Fuite', ['Normal', 'Vol']],
            [85, 'Otaria', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/86.png', 1.0, 29.5, 'Mâle', 'Absorb Eau', ['Eau']],
            [86, 'Otaria', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/87.png', 1.1, 60.0, 'Mâle', 'Absorb Eau', ['Eau']],
            [87, 'Lamantine', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/88.png', 2.5, 120.0, 'Mâle', 'Absorb Eau', ['Eau', 'Glace']],
            [88, 'Tadmorv', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/89.png', 0.8, 30.0, 'Mâle', 'Point Poison', ['Poison']],
            [89, 'Grotadmorv', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/90.png', 1.2, 39.0, 'Mâle', 'Point Poison', ['Poison']],
            [90, 'Kokiyas', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/91.png', 0.3, 2.3, 'Mâle', 'Armurbaston', ['Eau']],
            [91, 'Crustabri', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/92.png', 1.2, 52.5, 'Mâle', 'Armurbaston', ['Eau']],
            [92, 'Fantominus', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/93.png', 1.3, 1.5, 'Mâle', 'Lévitation', ['Spectre', 'Poison']],
            [93, 'Spectrum', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/94.png', 1.5, 40.5, 'Mâle', 'Lévitation', ['Spectre', 'Poison']],
            [94, 'Ectoplasma', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/95.png', 1.6, 40.5, 'Mâle', 'Lévitation', ['Spectre', 'Poison']],
            [95, 'Onix', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/96.png', 8.8, 210.0, 'Mâle', 'Tête de Roc', ['Roche', 'Sol']],
            [96, 'Soporifik', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/97.png', 1.6, 32.0, 'Mâle', 'Insomnia', ['Psy']],
            [97, 'Hypnomade', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/98.png', 2.2, 70.5, 'Mâle', 'Insomnia', ['Psy']],
            [98, 'Krabby', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/99.png', 0.4, 6.5, 'Mâle', 'Armurbaston', ['Eau']],
            [99, 'Krabboss', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/100.png', 1.3, 60.0, 'Mâle', 'Armurbaston', ['Eau']],
            [100, 'Voltorbe', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/101.png', 0.5, 10.4, 'Mâle', 'Statik', ['Électrik']],
            [101, 'Électrode', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/102.png', 1.2, 66.6, 'Mâle', 'Statik', ['Électrik']],
            [102, 'Noeunoeuf', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/103.png', 0.4, 1.9, 'Mâle', 'Coque Armure', ['Normal']],
            [103, 'Noadkoko', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/104.png', 2.0, 75.0, 'Mâle', 'Chlorophylle', ['Plante', 'Vol']],
            [104, 'Osselait', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/105.png', 0.5, 15.0, 'Mâle', 'Fermeté', ['Sol']],
            [105, 'Ossatueur', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/106.png', 1.4, 105.0, 'Mâle', 'Fermeté', ['Sol']],
            [106, 'Kicklee', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/107.png', 1.5, 49.8, 'Mâle', 'Joli Pied', ['Combat']],
            [107, 'Tygnon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/108.png', 0.6, 21.0, 'Mâle', 'Joli Pied', ['Combat']],
            [108, 'Excelangue', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/109.png', 1.5, 65.5, 'Mâle', 'Ramassage', ['Normal']],
            [109, 'Smogo', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/110.png', 1.2, 30.0, 'Mâle', 'Écran Poudre', ['Poison']],
            [110, 'Smogogo', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/111.png', 1.6, 60.0, 'Mâle', 'Écran Poudre', ['Poison', 'Plante']],
            [111, 'Rhinocorne', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/112.png', 1.0, 115.0, 'Mâle', 'Armurbaston', ['Sol', 'Roche']],
            [112, 'Rhinoféros', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/113.png', 1.9, 120.0, 'Mâle', 'Armurbaston', ['Sol', 'Roche']],
            [113, 'Leveinard', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/114.png', 1.1, 34.6, 'Femelle', 'Garde Magik', ['Normal']],
            [114, 'Saquedeneu', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/115.png', 0.6, 3.6, 'Mâle', 'Glissade', ['Plante']],
            [115, 'Kangourex', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/116.png', 2.2, 80.0, 'Mâle', 'Esprit Vital', ['Normal']],
            [116, 'Hypotrempe', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/117.png', 0.4, 8.0, 'Mâle', 'Torrent', ['Eau']],
            [117, 'Hypocéan', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/118.png', 1.0, 29.0, 'Mâle', 'Torrent', ['Eau']],
            [118, 'Poissirène', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/119.png', 0.6, 7.0, 'Mâle', 'Glissade', ['Eau']],
            [119, 'Poissoroy', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/120.png', 1.5, 39.0, 'Mâle', 'Glissade', ['Eau']],
            [120, 'Stari', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/121.png', 0.8, 34.5, 'Mâle', 'Ramassage', ['Eau']],
            [121, 'Staross', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/122.png', 1.1, 85.0, 'Mâle', 'Ramassage', ['Eau', 'Psy']],
            [122, 'M. Mime', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/122.png', 1.3, 54.5, 'Mâle', 'Synchronie', ['Psy', 'Fée']],
            [123, 'Insécateur', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/123.png', 0.5, 5.0, 'Mâle', 'Essaim', ['Insecte', 'Vol']],
            [124, 'Lippoutou', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/124.png', 1.2, 44.0, 'Femelle', 'Intimidation', ['Glace', 'Psy']],
            [125, 'Élektek', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/125.png', 1.4, 30.0, 'Mâle', 'Statik', ['Électrik']],
            [126, 'Magmar', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/126.png', 1.3, 44.5, 'Mâle', 'Brasier', ['Feu']],
            [127, 'Scarabrute', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/127.png', 1.5, 55.0, 'Mâle', 'Essaim', ['Insecte', 'Vol']],
            [128, 'Tauros', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/128.png', 1.4, 88.4, 'Mâle', 'Intimidation', ['Normal']],
            [129, 'Magicarpe', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/129.png', 0.9, 10.0, 'Mâle', 'Fuite', ['Eau']],
            [130, 'Léviator', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/130.png', 2.0, 235.0, 'Mâle', 'Intimidation', ['Eau', 'Vol']],
            [131, 'Lokhlass', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/131.png', 2.5, 220.0, 'Femelle', 'Absorb Eau', ['Eau', 'Glace']],
            [132, 'Métamorph', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/132.png', 0.3, 4.0, 'Mâle', 'Mutualiste', ['Normal']],
            [133, 'Évoli', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/133.png', 0.3, 6.5, 'Mâle', 'Adaptabilité', ['Normal']],
            [134, 'Aquali', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/134.png', 1.0, 29.0, 'Femelle', 'Absorb Eau', ['Eau']],
            [135, 'Voltali', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/135.png', 0.8, 24.5, 'Mâle', 'Statik', ['Électrik']],
            [136, 'Pyroli', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/136.png', 0.9, 25.5, 'Femelle', 'Brasier', ['Feu']],
            [137, 'Porygon', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/137.png', 0.8, 36.5, 'Mâle', 'Télécharge', ['Normal']],
            [138, 'Amonita', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/138.png', 0.4, 7.5, 'Femelle', 'Coque Armure', ['Roche', 'Eau']],
            [139, 'Amonistar', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/139.png', 1.0, 35.0, 'Mâle', 'Coque Armure', ['Roche', 'Eau']],
            [140, 'Kabuto', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/140.png', 0.5, 11.5, 'Mâle', 'Coque Armure', ['Roche', 'Eau']],
            [141, 'Kabutops', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/141.png', 1.3, 40.5, 'Mâle', 'Coque Armure', ['Roche', 'Eau']],
            [142, 'Ptéra', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/142.png', 1.8, 59.0, 'Mâle', 'Lévitation', ['Roche', 'Vol']],
            [143, 'Ronflex', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/143.png', 2.1, 460.0, 'Mâle', 'Isograisse', ['Normal']],
            [144, 'Artikodin', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/144.png', 1.7, 55.4, 'Femelle', 'Pression', ['Glace', 'Vol']],
            [145, 'Électhor', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/145.png', 1.6, 52.6, 'Mâle', 'Pression', ['Électrik', 'Vol']],
            [146, 'Sulfura', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/146.png', 2.0, 60.0, 'Femelle', 'Pression', ['Feu', 'Vol']],
            [147, 'Minidraco', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/147.png', 0.3, 8.0, 'Mâle', 'Intimidation', ['Dragon']],
            [148, 'Draco', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/148.png', 1.1, 16.5, 'Mâle', 'Intimidation', ['Dragon']],
            [149, 'Dracolosse', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/149.png', 2.3, 210.0, 'Femelle', 'Intimidation', ['Dragon', 'Vol']],
            [150, 'Mewtwo', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/150.png', 2.0, 122.0, 'Mâle', 'Pression', ['Psy']],
            [151, 'Mew', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/151.png', 0.4, 4.0, 'Femelle', 'Synchronie', ['Psy']],
        ];


        foreach ($pokemons as [$pokedexId, $name, $imgSrc, $size, $weight, $sex, $talentName, $typeNames]) {
            $pokemon = new Pokemon();
            $pokemon->setName($name);
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
        }

        $manager->flush();
    }
}
