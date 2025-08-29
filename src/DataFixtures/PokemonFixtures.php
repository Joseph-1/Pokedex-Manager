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
            'Chant' => 'Augmente la puissance de la capacité Chant Canon lorsqu\'elle est utilisée successivement par plusieurs Pokémon alliés.',
            'Échappée' => 'Permet au Pokémon de fuir n’importe quel Pokémon sauvage sans échec, sauf si l’adversaire possède les talents Regard Noir ou Toile.',
            'Robustesse' => 'Empêche le Pokémon d’être mis K.O. en un seul coup, sauf si l’attaque inflige un coup critique.',
            'Poison' => 'Augmente de 20 % la puissance des attaques de type Poison.',
            'Glu' => 'Empêche le Pokémon de perdre son objet tenu, même si l’adversaire utilise des capacités comme Larcin, Tourmagik ou Sabotage.',
            'Maternel' => 'Augmente la puissance des capacités de type Insecte du Pokémon quand ses PV sont inférieurs à 1/3.',
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
            [4, 'Salamèche', ' La flamme au bout de sa queue représente sa vitalité. Quand Salamèche n’est pas au meilleur de sa forme, elle faiblit. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/4.png', 0.6, 8.5, 'Mâle', 'Brasier', ['Feu'], ['Reptincel']],
            [5, 'Reptincel', ' En agitant sa queue enflammée, il peut élever la température ambiante de manière exponentielle et ainsi tourmenter ses adversaires. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/5.png', 1.1, 19.0, 'Mâle', 'Brasier', ['Feu'], ['Dracaufeu']],
            [6, 'Dracaufeu', ' Quand Dracaufeu s’énerve réellement, la flamme au bout de sa queue devient bleue. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/6.png', 1.7, 90.5, 'Femelle', 'Brasier', ['Feu', 'Vol'], []],
            [7, 'Carapuce', ' Ce Pokémon crache une écume redoutable. Après sa naissance, son dos gonfle et durcit pour former une carapace. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/7.png', 0.5, 9.0, 'Mâle', 'Torrent', ['Eau'], ['Carabaffe']],
            [8, 'Carabaffe', ' Sa longue queue touffue est un symbole de longévité. Les personnes âgées apprécient donc particulièrement ce Pokémon. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/8.png', 1.0, 22.5, 'Mâle', 'Torrent', ['Eau'], ['Tortank']],
            [9, 'Tortank', ' Il augmente délibérément sa masse corporelle pour contrer le recul de ses puissants jets d’eau. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/9.png', 1.6, 85.5, 'Femelle', 'Torrent', ['Eau'], []],
            [10, 'Chenipan', ' Pour se protéger, il émet par ses antennes une odeur nauséabonde qui fait fuir ses ennemis. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/10.png', 0.3, 2.9, 'Mâle', 'Écran Poudre', ['Insecte'], ['Chrysacier']],
            [11, 'Chrysacier', ' En attendant sa prochaine évolution, il ne peut que durcir sa carapace et rester immobile pour éviter de se faire attaquer. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/11.png', 0.7, 9.9, 'Mâle', 'Mue', ['Insecte'], ['Papilusion']],
            [12, 'Papilusion', ' Ce Pokémon raffole du nectar des fleurs. Il est capable de dénicher des champs fleuris même s’ils n’ont qu’une quantité infime de pollen. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/12.png', 1.1, 32.0, 'Femelle', 'Écran Poudre', ['Insecte', 'Vol'], []],
            [13, 'Aspicot', ' L’aiguillon sur son front est très pointu. Il se cache dans les bois et les hautes herbes, où il se gave de feuilles. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/13.png', 0.3, 3.2, 'Mâle', 'Écran Poudre', ['Insecte', 'Poison'], ['Coconfort']],
            [14, 'Coconfort', ' Il peut à peine bouger. Quand il est menacé, il sort parfois son aiguillon pour empoisonner ses ennemis. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/14.png', 0.6, 10.0, 'Mâle', 'Mue', ['Insecte', 'Poison'], ['Dardargnan']],
            [15, 'Dardargnan', ' Il se sert de ses trois aiguillons empoisonnés situés sur les pattes avant et l’abdomen pour attaquer sans relâche ses adversaires. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/15.png', 1.0, 29.5, 'Femelle', 'Essaim', ['Insecte', 'Vol'], []],
            [16, 'Roucool', ' De nature très docile, il préfère projeter du sable pour se défendre plutôt que contre-attaquer. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/16.png', 0.3, 1.8, 'Mâle', 'Regard Vif', ['Normal', 'Vol'], ['Roucoups']],
            [17, 'Roucoups', ' Ce Pokémon est très endurant. Il survole en permanence son territoire pour chasser. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/17.png', 1.1, 30.0, 'Mâle', 'Regard Vif', ['Normal', 'Vol'], ['Roucarnage']],
            [18, 'Roucarnage', ' Ce Pokémon vole à Mach 2 quand il chasse. Ses grandes serres sont des armes redoutables. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/18.png', 1.5, 39.5, 'Femelle', 'Regard Vif', ['Normal', 'Vol'], []],
            [19, 'Rattata', ' Il peut ronger n’importe quoi avec ses deux dents. Quand on en voit un, il y en a certainement 40 dans le coin. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/19.png', 0.3, 3.5, 'Mâle', 'Fuite', ['Normal'], ['Rattatac']],
            [20, 'Rattatac', ' Ses pattes arrière sont palmées. Il peut donc poursuivre sa proie dans les cours d’eau et les rivières. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/20.png', 0.7, 18.5, 'Femelle', 'Fuite', ['Normal'], []],
            [21, 'Piafabec', ' Il est incapable de voler à haute altitude. Il se déplace très vite pour protéger son territoire. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/21.png', 0.3, 2.0, 'Mâle', 'Regard Vif', ['Normal', 'Vol'], ['Rapasdepic']],
            [22, 'Rapasdepic', ' Un Pokémon très ancien. S’il perçoit un danger, il fuit instantanément à haute altitude. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/22.png', 1.2, 38.0, 'Femelle', 'Regard Vif', ['Normal', 'Vol'], []],
            [23, 'Abo', ' Sa mâchoire peut se désarticuler. Il est ainsi en mesure d’avaler de larges proies, mais ce faisant, il devient trop lourd pour bouger. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/23.png', 2.0, 6.9, 'Mâle', 'Intimidation', ['Poison'], ['Arbok']],
            [24, 'Arbok', ' Le motif sur son corps ressemble à un visage menaçant. Les adversaires les plus craintifs fuient à la seule vue de ce Pokémon. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/24.png', 3.5, 65.0, 'Femelle', 'Intimidation', ['Poison'], []],
            [25, 'Pikachu', ' Quand il s’énerve, il libère instantanément l’énergie emmagasinée dans les poches de ses joues. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/25.png', 0.4, 6.0, 'Mâle', 'Statik', ['Électrik'], ['Raichu']],
            [26, 'Raichu', ' Il se protège des décharges grâce à sa queue, qui dissipe l’électricité dans le sol. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/26.png', 0.8, 30.0, 'Femelle', 'Statik', ['Électrik'], []],
            [27, 'Sabelette', ' Il vit dans les profonds tunnels qu’il creuse. En cas de danger, il se roule en boule pour encaisser les coups de ses adversaires. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/27.png', 0.6, 12.0, 'Mâle', 'Voile Sable', ['Sol'], ['Sablaireau']],
            [28, 'Sablaireau', ' Il attaque en se déplaçant rapidement et blesse ses adversaires à l’aide des piques sur son dos et de ses griffes acérées. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/28.png', 1.0, 29.5, 'Femelle', 'Voile Sable', ['Sol'], []],
            [29, 'Nidoran♀', ' Son odorat est plus développé que celui du mâle. Quand Nidoran♀ cherche à manger, il reste dans le sens du vent, qu’il détecte avec ses vibrisses. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/29.png', 0.4, 7.0, 'Femelle', 'Point Poison', ['Poison'], ['Nidorina']],
            [30, 'Nidorina', ' On pense que sa corne frontale s’est atrophiée pour lui permettre de nourrir ses petits sans les blesser. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/30.png', 0.8, 20.0, 'Femelle', 'Point Poison', ['Poison'], ['Nidoqueen']],
            [31, 'Nidoqueen', 'Nidoqueen possède un corps robuste qui lui permet de creuser et de protéger son territoire avec une force incroyable.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/31.png', 1.3, 60.0, 'Femelle', 'Point Poison', ['Poison', 'Sol'], []],
            [32, 'Nidoran♂', 'Nidoran♂ est vigilant et utilise ses piquants pour se défendre contre les prédateurs.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/32.png', 0.5, 9.0, 'Mâle', 'Point Poison', ['Poison'], ['Nidorino']],
            [33, 'Nidorino', 'Nidorino possède une corne plus dure et plus pointue que son préévolué Nidoran♂, qu’il utilise pour attaquer.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/33.png', 0.9, 19.5, 'Mâle', 'Point Poison', ['Poison'], ['Nidoking']],
            [34, 'Nidoking', 'Nidoking est puissant et rapide. Sa queue et sa corne lui servent de redoutables armes.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/34.png', 1.4, 62.0, 'Mâle', 'Point Poison', ['Poison', 'Sol'], []],
            [35, 'Mélofée', 'Mélofée émet des sons doux qui calment les Pokémon et les humains autour d’elle.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/35.png', 0.6, 7.5, 'Femelle', 'Mue', ['Fée'], ['Mélodelfe']],
            [36, 'Mélodelfe', 'Mélodelfe peut produire des sons mélodieux qui endorment ses ennemis ou apaisent ses alliés.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/36.png', 1.2, 40.0, 'Femelle', 'Mue', ['Fée'], []],
            [37, 'Goupix', 'Goupix possède une queue touffue et des neuf queues légendaires qui dégagent une chaleur magique.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/37.png', 0.6, 9.9, 'Mâle', 'Brasier', ['Feu'], ['Feunard']],
            [38, 'Feunard', 'Feunard est rapide et rusé. Ses neuf queues produisent des flammes magiques.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/38.png', 1.1, 19.9, 'Mâle', 'Brasier', ['Feu'], []],
            [39, 'Rondoudou', 'Rondoudou chante pour endormir ses adversaires et se défendre.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/39.png', 0.5, 5.5, 'Mâle', 'Chant', ['Normal', 'Fée'], ['Grodoudou']],
            [40, 'Grodoudou', 'Grodoudou peut gonfler son corps et chanter pour immobiliser ses ennemis.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/40.png', 1.0, 12.0, 'Femelle', 'Chant', ['Normal', 'Fée'], []],
            [41, 'Nosferapti', 'Nosferapti se déplace rapidement dans la nuit pour chasser ses proies.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/41.png', 0.8, 7.5, 'Mâle', 'Échappée', ['Poison', 'Vol'], ['Nosferalto']],
            [42, 'Nosferalto', 'Nosferalto possède de puissantes ailes et peut infliger des morsures venimeuses à ses ennemis.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/42.png', 1.8, 55.0, 'Mâle', 'Échappée', ['Poison', 'Vol'], []],
            [43, 'Mystherbe', 'Mystherbe possède des feuilles toxiques qui repoussent les ennemis.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/43.png', 0.5, 4.0, 'Mâle', 'Chlorophylle', ['Plante', 'Poison'], ['Ortide']],
            [44, 'Ortide', 'Ortide attire ses proies avec un parfum floral avant de les attaquer.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/44.png', 0.8, 15.2, 'Mâle', 'Chlorophylle', ['Plante', 'Poison'], ['Rafflesia']],
            [45, 'Rafflesia', 'Rafflesia possède une grande fleur qui sécrète un parfum puissant pour attirer les proies.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/45.png', 1.2, 29.5, 'Femelle', 'Chlorophylle', ['Plante', 'Poison'], []],
            [46, 'Paras', 'Paras a des champignons sur son dos qui influencent ses mouvements et sa croissance.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/46.png', 0.3, 5.4, 'Mâle', 'Champi', ['Insecte', 'Plante'], ['Parasect']],
            [47, 'Parasect', 'Parasect est contrôlé par le champignon sur son dos, ce qui lui permet de manipuler son environnement.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/47.png', 0.9, 29.5, 'Mâle', 'Champi', ['Insecte', 'Plante'], []],
            [48, 'Mimitoss', 'Mimitoss produit des spores toxiques pour se défendre contre les ennemis.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/48.png', 0.3, 3.2, 'Mâle', 'Essaim', ['Insecte', 'Poison'], ['Aéromite']],
            [49, 'Aéromite', 'Aéromite utilise ses ailes pour planer et disperser ses spores sur ses ennemis.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/49.png', 1.0, 12.5, 'Mâle', 'Essaim', ['Insecte', 'Poison'], []],
            [50, 'Taupiqueur', 'Taupiqueur creuse des tunnels pour se cacher et attaquer ses proies.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/50.png', 0.4, 5.0, 'Mâle', 'Voile Sable', ['Sol'], ['Triopikeur']],
            [51, 'Triopikeur', 'Triopikeur creuse rapidement et peut bloquer ses ennemis dans ses tunnels.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/51.png', 0.8, 32.8, 'Mâle', 'Voile Sable', ['Sol'], []],
            [52, 'Miaouss', 'Miaouss aime l’or et reste éveillé la nuit pour le chercher.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/52.png', 0.4, 4.2, 'Mâle', 'Ramassage', ['Normal'], ['Persian']],
            [53, 'Persian', 'Persian est élégant et rapide. Il utilise ses griffes pour se défendre et chasser.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/53.png', 1.0, 32.0, 'Mâle', 'Ramassage', ['Normal'], []],
            [54, 'Psykokwak', 'Psykokwak souffre de maux de tête constants, ce qui le rend souvent confus.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/54.png', 0.8, 19.6, 'Mâle', 'Torrent', ['Eau'], ['Akwakwak']],
            [55, 'Akwakwak', 'Akwakwak utilise sa queue puissante et ses attaques d’eau pour se défendre et chasser.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/55.png', 1.6, 79.6, 'Mâle', 'Torrent', ['Eau'], []],
            [56, 'Férosinge', 'Férosinge est très agressif et attaque rapidement avec ses poings.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/56.png', 0.5, 12.0, 'Mâle', 'Agitation', ['Combat'], ['Colossinge']],
            [57, 'Colossinge', 'Colossinge est extrêmement rapide et puissant, capable de terrasser ses adversaires avec ses coups.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/57.png', 1.0, 32.0, 'Mâle', 'Agitation', ['Combat'], []],
            [58, 'Caninos', 'Caninos est loyal et courageux. Il peut courir très vite et brûler tout sur son passage.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/58.png', 0.9, 19.0, 'Mâle', 'Brasier', ['Feu'], ['Arcanin']],
            [59, 'Arcanin', 'Arcanin est majestueux et rapide, capable de parcourir de longues distances en un instant.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/59.png', 1.9, 155.0, 'Mâle', 'Brasier', ['Feu'], []],
            [60, 'Ptitard', 'Ptitard vit près de l’eau et émet des sons aigus pour communiquer.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/60.png', 0.5, 9.0, 'Mâle', 'Torrent', ['Eau'], ['Têtarte']],
            [61, 'Têtarte', 'Têtarte devient plus fort à mesure qu’il apprend à utiliser ses attaques aquatiques.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/61.png', 0.9, 22.5, 'Mâle', 'Torrent', ['Eau'], ['Tartard']],
            [62, 'Tartard', 'Tartard utilise ses puissantes jambes pour frapper et ses capacités aquatiques pour attaquer.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/62.png', 1.6, 55.0, 'Mâle', 'Torrent', ['Eau', 'Combat'], []],
            [63, 'Abra', 'Abra peut se téléporter pour éviter les combats et se protéger.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/63.png', 0.9, 19.5, 'Mâle', 'Synchronisation', ['Psy'], ['Kadabra']],
            [64, 'Kadabra', 'Kadabra possède de puissants pouvoirs psychiques et une cuillère qui amplifie ses capacités.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/64.png', 1.3, 56.5, 'Mâle', 'Synchronisation', ['Psy'], ['Alakazam']],
            [65, 'Alakazam', 'Alakazam possède un QI extrêmement élevé et des pouvoirs psychiques très développés.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/65.png', 1.5, 48.0, 'Mâle', 'Synchronisation', ['Psy'], []],
            [66, 'Machoc', 'Machoc est extrêmement fort pour sa taille et s’entraîne sans cesse pour devenir plus puissant.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/66.png', 0.8, 19.5, 'Mâle', 'Cran', ['Combat'], ['Machopeur']],
            [67, 'Machopeur', 'Machopeur a des muscles impressionnants et peut frapper avec une force incroyable.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/67.png', 1.5, 70.5, 'Mâle', 'Cran', ['Combat'], ['Mackogneur']],
            [68, 'Mackogneur', 'Mackogneur est extrêmement puissant et peut vaincre plusieurs adversaires simultanément grâce à sa force.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/68.png', 1.6, 130.0, 'Mâle', 'Cran', ['Combat'], []],
            [69, 'Chétiflor', 'Chétiflor aime les endroits humides et se nourrit de petites baies.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/69.png', 0.4, 2.2, 'Mâle', 'Engrais', ['Plante', 'Poison'], ['Boustiflor']],
            [70, 'Boustiflor', 'Boustiflor est robuste et utilise son attaque de liane pour se défendre.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/70.png', 0.7, 4.0, 'Mâle', 'Engrais', ['Plante', 'Poison'], ['Empiflor']],
            [71, 'Empiflor', 'Empiflor possède une grande fleur sur son dos qui capte l’énergie du soleil.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/71.png', 1.2, 15.5, 'Mâle', 'Engrais', ['Plante', 'Poison'], []],
            [72, 'Tentacool', 'Tentacool flotte dans l’eau et utilise ses tentacules pour capturer ses proies.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/72.png', 0.9, 45.5, 'Mâle', 'Absorb Eau', ['Eau', 'Poison'], ['Tentacruel']],
            [73, 'Tentacruel', 'Tentacruel possède de nombreux tentacules et un corps toxique pour repousser les prédateurs.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/73.png', 1.6, 55.0, 'Mâle', 'Absorb Eau', ['Eau', 'Poison'], []],
            [74, 'Racaillou', 'Racaillou est solide et robuste, parfait pour rouler et attaquer ses adversaires.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/74.png', 0.4, 20.0, 'Mâle', 'Robustesse', ['Roche', 'Sol'], ['Gravalanch']],
            [75, 'Gravalanch', 'Gravalanch est plus lourd et plus fort que Racaillou, capable de créer de puissantes secousses.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/75.png', 1.0, 105.0, 'Mâle', 'Robustesse', ['Roche', 'Sol'], ['Grolem']],
            [76, 'Grolem', 'Grolem possède un corps lourd et robuste capable de protéger ses alliés et de résister aux attaques.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/76.png', 1.4, 300.0, 'Mâle', 'Robustesse', ['Roche', 'Sol'], []],
            [77, 'Ponyta', 'Ponyta est rapide et majestueux, ses flammes de crinière brillent lorsqu’il court.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/77.png', 1.0, 30.0, 'Mâle', 'Brasier', ['Feu'], ['Galopa']],
            [78, 'Galopa', 'Galopa peut atteindre des vitesses impressionnantes grâce à sa crinière enflammée.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/78.png', 1.7, 95.0, 'Mâle', 'Brasier', ['Feu'], []],
            [79, 'Ramoloss', 'Ramoloss est lent et tranquille, mais il possède une grande force physique.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/79.png', 1.2, 36.0, 'Mâle', 'Absorb Eau', ['Eau', 'Psy'], ['Flagadoss']],
            [80, 'Flagadoss', 'Flagadoss est très puissant et peut utiliser ses pouvoirs psychiques pour attaquer.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/80.png', 1.8, 78.0, 'Mâle', 'Absorb Eau', ['Eau', 'Psy'], []],
            [81, 'Magnéti', 'Magnéti est magnétique et attire les objets métalliques à proximité.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/81.png', 0.3, 6.0, 'Mâle', 'Lévitation', ['Électrik', 'Acier'], ['Magnéton']],
            [82, 'Magnéton', 'Magnéton combine plusieurs Magnéti pour former un Pokémon plus puissant.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/82.png', 1.0, 60.0, 'Mâle', 'Lévitation', ['Électrik', 'Acier'], []],
            [83, 'Canarticho', 'Canarticho utilise ses ailes puissantes pour se battre et défendre son territoire.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/83.png', 1.2, 75.0, 'Mâle', 'Intimidation', ['Normal', 'Vol'], []],
            [84, 'Doduo', 'Doduo est rapide grâce à ses deux jambes et peut parcourir de grandes distances.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/84.png', 1.4, 39.2, 'Mâle', 'Fuite', ['Normal', 'Vol'], ['Dodrio']],
            [85, 'Dodrio', 'Dodrio est très rapide et puissant, avec ses trois têtes qui coordonnent leurs attaques.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/85.png', 1.8, 85.2, 'Mâle', 'Fuite', ['Normal', 'Vol'], []],
            [86, 'Otaria', 'Otaria est agile dans l’eau et utilise ses nageoires pour se défendre.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/86.png', 1.0, 60.0, 'Femelle', 'Isograisse', ['Eau'], ['Lamantine']],
            [87, 'Lamantine', 'Lamantine est un Pokémon doux qui nage avec grâce et protège les jeunes de son groupe.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/87.png', 2.2, 120.0, 'Femelle', 'Isograisse', ['Eau', 'Glace'], []],
            [88, 'Tadmorv', 'Tadmorv sécrète un liquide toxique qui peut dissoudre la plupart des matériaux.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/88.png', 0.8, 30.0, 'Mâle', 'Poison', ['Poison'], ['Grotadmorv']],
            [89, 'Grotadmorv', 'Grotadmorv est plus puissant que Tadmorv et peut empoisonner de larges zones.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/89.png', 1.2, 80.0, 'Mâle', 'Poison', ['Poison'], []],
            [90, 'Kokiyas', 'Kokiyas a une coquille solide qui le protège des prédateurs.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/90.png', 0.5, 8.5, 'Mâle', 'Coque Armure', ['Eau'], ['Crustabri']],
            [91, 'Crustabri', 'Crustabri est un prédateur redoutable dans les fonds marins avec sa puissante pince.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/91.png', 1.2, 60.0, 'Mâle', 'Coque Armure', ['Eau', 'Glace'], []],
            [92, 'Fantominus', 'Fantominus est un spectre mystérieux qui se déplace silencieusement.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/92.png', 1.3, 1.0, 'Mâle', 'Lévitation', ['Spectre', 'Poison'], ['Spectrum']],
            [93, 'Spectrum', 'Spectrum est plus puissant que Fantominus et utilise ses pouvoirs spectres pour effrayer.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/93.png', 1.5, 15.5, 'Mâle', 'Lévitation', ['Spectre', 'Poison'], ['Ectoplasma']],
            [94, 'Ectoplasma', 'Ectoplasma est extrêmement rapide et peut traverser les murs pour surprendre ses ennemis.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/94.png', 1.6, 40.5, 'Mâle', 'Lévitation', ['Spectre', 'Poison'], []],
            [95, 'Onix', 'Onix est un serpent de roche gigantesque capable de creuser à grande vitesse.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/95.png', 8.8, 210.0, 'Mâle', 'Robustesse', ['Roche', 'Sol'], []],
            [96, 'Soporifik', 'Soporifik utilise ses pouvoirs psychiques pour endormir ses ennemis.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/96.png', 1.6, 61.0, 'Mâle', 'Insomnia', ['Psy'], ['Hypnomade']],
            [97, 'Hypnomade', 'Hypnomade manipule ses ennemis grâce à ses pouvoirs hypnotiques puissants.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/97.png', 2.1, 75.6, 'Mâle', 'Insomnia', ['Psy'], []],
            [98, 'Krabby', 'Krabby utilise ses pinces puissantes pour se défendre et attraper sa nourriture.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/98.png', 0.4, 6.5, 'Mâle', 'Coque Armure', ['Eau'], ['Krabboss']],
            [99, 'Krabboss', 'Krabboss est le roi des crabes, sa pince gauche est massive et très puissante.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/99.png', 1.3, 60.0, 'Mâle', 'Coque Armure', ['Eau'], []],
            [100, 'Voltorbe', 'Voltorbe ressemble à une Poké Ball et peut exploser lorsqu’il est dérangé.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/100.png', 0.5, 10.4, 'Mâle', 'Statik', ['Électrik'], ['Électrode']],
            [101, 'Électrode', 'Électrode est capable de provoquer de puissantes explosions électriques.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/101.png', 1.2, 66.6, 'Mâle', 'Statik', ['Électrik'], []],
            [102, 'Noeunoeuf', 'Noeunoeuf se balance et utilise sa coquille pour se protéger des prédateurs.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/102.png', 0.4, 1.0, 'Mâle', 'Coque Armure', ['Normal'], ['Noadkoko']],
            [103, 'Noadkoko', 'Noadkoko est très puissant et peut utiliser ses multiples têtes pour attaquer simultanément.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/103.png', 2.0, 75.0, 'Mâle', 'Chlorophylle', ['Plante', 'Vol'], []],
            [104, 'Osselait', 'Osselait tient fermement son os pour se défendre et chasser.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/104.png', 0.5, 5.0, 'Mâle', 'Robustesse', ['Sol'], ['Ossatueur']],
            [105, 'Ossatueur', 'Ossatueur est un Pokémon très agressif utilisant son os comme arme de combat.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/105.png', 1.4, 40.8, 'Mâle', 'Robustesse', ['Sol'], []],
            [106, 'Kicklee', 'Kicklee est spécialisé dans les coups de pied et possède une vitesse exceptionnelle.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/106.png', 1.0, 49.8, 'Mâle', 'Cran', ['Combat'], []],
            [107, 'Tygnon', 'Tygnon utilise ses poings puissants pour vaincre ses adversaires dans les combats rapprochés.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/107.png', 1.1, 52.2, 'Mâle', 'Cran', ['Combat'], ['Kicklee']],
            [108, 'Excelangue', 'Excelangue a une langue très longue qu’il utilise pour capturer des objets ou attaquer.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/108.png', 1.5, 65.5, 'Mâle', 'Glu', ['Normal'], []],
            [109, 'Smogo', 'Smogo dégage un gaz toxique qui peut empoisonner ses ennemis.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/109.png', 1.2, 30.0, 'Mâle', 'Lévitation', ['Poison'], ['Smogogo']],
            [110, 'Smogogo', 'Smogogo peut former un nuage de gaz dangereux autour de lui pour attaquer.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/110.png', 1.6, 40.0, 'Mâle', 'Lévitation', ['Poison'], []],
            [111, 'Rhinocorne', 'Rhinocorne charge avec sa corne pour terrasser ses adversaires.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/111.png', 1.0, 115.0, 'Mâle', 'Armurbaston', ['Sol', 'Roche'], ['Rhinoféros']],
            [112, 'Rhinoféros', 'Rhinoféros est extrêmement robuste et peut encaisser des attaques puissantes.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/112.png', 1.9, 120.0, 'Mâle', 'Armurbaston', ['Sol', 'Roche'], []],
            [113, 'Leveinard', 'Leveinard protège ses œufs précieusement dans sa poche ventrale.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/113.png', 1.2, 34.6, 'Femelle', 'Garde Magik', ['Normal'], []],
            [114, 'Saquedeneu', 'Saquedeneu se cache dans la végétation et peut projeter des aiguilles tranchantes.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/114.png', 1.3, 56.5, 'Mâle', 'Agitation', ['Plante'], []],
            [115, 'Kangourex', 'Kangourex porte son petit dans sa poche et se bat avec des coups puissants.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/115.png', 2.2, 80.0, 'Mâle', 'Maternel', ['Normal'], []],
            [116, 'Hypotrempe', 'Hypotrempe vit dans les eaux calmes et utilise sa queue pour se propulser.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/116.png', 0.8, 8.0, 'Mâle', 'Torrent', ['Eau'], ['Hypocéan']],
            [117, 'Hypocéan', 'Hypocéan est plus puissant et rapide que sa pré-évolution, Hypotrempe.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/117.png', 1.8, 40.0, 'Mâle', 'Torrent', ['Eau'], []],
            [118, 'Poissirène', 'Poissirène nage avec grâce et utilise ses nageoires pour attaquer ou se défendre.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/118.png', 0.6, 9.8, 'Mâle', 'Absorb Eau', ['Eau'], ['Poissoroy']],
            [119, 'Poissoroy', 'Poissoroy est agile et peut sauter hors de l’eau pour surprendre ses ennemis.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/119.png', 2.7, 61.0, 'Mâle', 'Absorb Eau', ['Eau'], []],
            [120, 'Stari', 'Stari utilise ses bras en forme d’étoile pour se déplacer et attraper de petites proies.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/120.png', 0.8, 34.5, 'Mâle', 'Écran Poudre', ['Eau', 'Psy'], ['Staross']],
            [121, 'Staross', 'Staross est rapide et peut utiliser des attaques psy puissantes pour se défendre.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/121.png', 1.1, 80.0, 'Mâle', 'Écran Poudre', ['Eau', 'Psy'], []],
            [122, 'M. Mime', 'M. Mime utilise ses pouvoirs psychiques pour créer des barrières invisibles.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/122.png', 1.3, 54.5, 'Mâle', 'Synchronisation', ['Psy', 'Fée'], []],
            [123, 'Insécateur', 'Insécateur est rapide et utilise ses pinces pour couper des obstacles ou attaquer.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/123.png', 1.0, 35.0, 'Mâle', 'Essaim', ['Insecte', 'Vol'], []],
            [124, 'Lippoutou', 'Lippoutou peut créer des clones et utiliser des attaques de glace et psy.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/124.png', 1.3, 48.0, 'Mâle', 'Glissade', ['Psy', 'Glace'], []],
            [125, 'Élektek', 'Élektek génère de puissantes décharges électriques pour neutraliser ses ennemis.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/125.png', 1.4, 50.0, 'Mâle', 'Statik', ['Électrik'], []],
            [126, 'Magmar', 'Magmar possède un corps brûlant qui lui permet de cracher des flammes.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/126.png', 1.3, 44.5, 'Mâle', 'Brasier', ['Feu'], []],
            [127, 'Scarabrute', 'Scarabrute est puissant et peut voler en piqué pour frapper ses ennemis.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/127.png', 1.5, 55.0, 'Mâle', 'Agitation', ['Insecte', 'Vol'], []],
            [128, 'Tauros', 'Tauros est très agressif et charge à grande vitesse pour intimider.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/128.png', 1.4, 88.4, 'Mâle', 'Intimidation', ['Normal'], []],
            [129, 'Magicarpe', 'Magicarpe est faible et saute souvent hors de l’eau, mais il peut évoluer en un puissant Gyarados.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/129.png', 0.9, 10.0, 'Mâle', 'Fuite', ['Eau'], ['Léviator']],
            [130, 'Léviator', 'Léviator est redoutable et attaque avec des coups de queue dévastateurs.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/130.png', 6.5, 235.0, 'Mâle', 'Intimidation', ['Eau', 'Vol'], []],
            [131, 'Lokhlass', 'Lokhlass est doux avec les humains mais puissant dans l’eau, il transporte les voyageurs sur son dos.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/131.png', 2.5, 220.0, 'Femelle', 'Absorb Eau', ['Eau', 'Glace'], []],
            [132, 'Métamorph', 'Métamorph peut se transformer en n’importe quel Pokémon pour tromper ses ennemis.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/132.png', 0.3, 4.0, 'Mâle', 'Impassible', ['Normal'], []],
            [133, 'Évoli', 'Évoli est un Pokémon très adaptable et peut évoluer en plusieurs formes différentes selon son environnement.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/133.png', 0.3, 6.5, 'Mâle', 'Adaptabilité', ['Normal'], ['Aquali', 'Voltali', 'Pyroli']],
            [134, 'Aquali', 'Aquali est capable de purifier l’eau qu’il traverse grâce à son corps aqueux.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/134.png', 1.0, 29.0, 'Femelle', 'Absorb Eau', ['Eau'], []],
            [135, 'Voltali', 'Voltali canalise l’électricité de son corps pour alimenter des attaques puissantes.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/135.png', 0.8, 24.5, 'Femelle', 'Statik', ['Électrik'], []],
            [136, 'Pyroli', 'Pyroli contrôle le feu avec précision, augmentant la température de son corps lorsqu’il combat.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/136.png', 0.9, 25.0, 'Femelle', 'Brasier', ['Feu'], []],
            [137, 'Porygon', 'Porygon peut se déplacer dans le cyberespace et modifier sa structure pour évoluer.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/137.png', 0.8, 36.5, 'Mâle', 'Télécharge', ['Normal'], []],
            [138, 'Amonita', 'Amonita est un fossile vivant qui se déplace en spirale et se protège avec sa carapace.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/138.png', 0.5, 7.5, 'Mâle', 'Coque Armure', ['Roche', 'Eau'], ['Amonistar']],
            [139, 'Amonistar', 'Amonistar utilise ses cornes et ses tentacules pour attaquer et capturer ses proies.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/139.png', 1.0, 35.0, 'Mâle', 'Coque Armure', ['Roche', 'Eau'], []],
            [140, 'Kabuto', 'Kabuto est un fossile qui a survécu à l’extinction et se protège avec sa carapace dure.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/140.png', 0.5, 11.5, 'Mâle', 'Coque Armure', ['Roche', 'Eau'], ['Kabutops']],
            [141, 'Kabutops', 'Kabutops attaque avec ses lames acérées et se déplace rapidement sur terre comme dans l’eau.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/141.png', 1.3, 40.5, 'Mâle', 'Coque Armure', ['Roche', 'Eau'], []],
            [142, 'Ptéra', 'Ptéra est un Pokémon préhistorique volant capable d’attaquer avec ses ailes et sa puissante mâchoire.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/142.png', 1.8, 59.0, 'Mâle', 'Pression', ['Roche', 'Vol'], []],
            [143, 'Ronflex', 'Ronflex dort profondément et ne bouge que pour manger, il peut engloutir des tonnes de nourriture.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/143.png', 2.1, 460.0, 'Mâle', 'Absorb Eau', ['Normal'], []],
            [144, 'Artikodin', 'Artikodin contrôle la glace et le vent glacial, il apparaît lors des hivers rigoureux.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/144.png', 1.7, 55.4, 'Mâle', 'Pression', ['Glace', 'Vol'], []],
            [145, 'Électhor', 'Électhor peut générer des éclairs puissants et se déplacer à grande vitesse dans le ciel.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/145.png', 2.0, 52.6, 'Mâle', 'Pression', ['Électrik', 'Vol'], []],
            [146, 'Sulfura', 'Sulfura est un oiseau légendaire enflammé qui vit dans les volcans et contrôle le feu.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/146.png', 2.0, 60.0, 'Mâle', 'Brasier', ['Feu', 'Vol'], []],
            [147, 'Minidraco', 'Minidraco est petit mais courageux, il évolue pour devenir un puissant dragon.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/147.png', 0.3, 8.0, 'Mâle', 'Armurbaston', ['Dragon'], ['Draco']],
            [148, 'Draco', 'Draco grandit et devient plus puissant avant d’atteindre sa forme finale.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/148.png', 1.2, 40.0, 'Mâle', 'Armurbaston', ['Dragon'], ['Dracolosse']],
            [149, 'Dracolosse', 'Dracolosse est un dragon légendaire capable de voler sur de longues distances avec puissance et grâce.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/149.png', 2.2, 210.0, 'Mâle', 'Armurbaston', ['Dragon', 'Vol'], []],
            [150, 'Mewtwo', 'Mewtwo est un Pokémon génétiquement modifié doté de puissants pouvoirs psychiques.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/150.png', 2.0, 122.0, 'Mâle', 'Pression', ['Psy'], []],
            [151, 'Mew', 'Mew est un Pokémon rare et mystérieux capable d’apprendre toutes les techniques existantes.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/151.png', 0.4, 4.0, 'Femelle', 'Synchro', ['Psy'], []],
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
