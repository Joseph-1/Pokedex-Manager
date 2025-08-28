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
            [1, 'Bulbizarre', 'Au début de sa vie, il se nourrit des nutriments accumulés dans la graine sur son dos. Cela lui permet de grandir. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/1.png', 0.7, 6.9, 'Mâle', 'Engrais', ['Plante', 'Poison']],
            [2, 'Herbizarre', 'Plus il s’expose au soleil, plus il emmagasine d’énergie, ce qui permet au bourgeon sur son dos de se développer.', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/2.png', 1.0, 13.0, 'Mâle', 'Engrais', ['Plante', 'Poison']],
            [3, 'Florizarre', ' Ce Pokémon est capable de transformer la lumière du soleil en énergie. Il est donc encore plus fort en été. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/3.png', 2.0, 100.0, 'Femelle', 'Engrais', ['Plante', 'Poison']],
            [4, 'Salamèche', ' La flamme au bout de sa queue représente sa vitalité. Quand Salamèche n’est pas au meilleur de sa forme, elle faiblit. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/4.png', 0.6, 8.5, 'Mâle', 'Brasier', ['Feu']],
            [5, 'Reptincel', ' En agitant sa queue enflammée, il peut élever la température ambiante de manière exponentielle et ainsi tourmenter ses adversaires. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/5.png', 1.1, 19.0, 'Mâle', 'Brasier', ['Feu']],
            [6, 'Dracaufeu', ' Quand Dracaufeu s’énerve réellement, la flamme au bout de sa queue devient bleue. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/6.png', 1.7, 90.5, 'Femelle', 'Brasier', ['Feu', 'Vol']],
            [7, 'Carapuce', ' Ce Pokémon crache une écume redoutable. Après sa naissance, son dos gonfle et durcit pour former une carapace. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/7.png', 0.5, 9.0, 'Mâle', 'Torrent', ['Eau']],
            [8, 'Carabaffe', ' Sa longue queue touffue est un symbole de longévité. Les personnes âgées apprécient donc particulièrement ce Pokémon. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/8.png', 1.0, 22.5, 'Mâle', 'Torrent', ['Eau']],
            [9, 'Tortank', ' Il augmente délibérément sa masse corporelle pour contrer le recul de ses puissants jets d’eau. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/9.png', 1.6, 85.5, 'Femelle', 'Torrent', ['Eau']],
            [10, 'Chenipan', ' Pour se protéger, il émet par ses antennes une odeur nauséabonde qui fait fuir ses ennemis. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/10.png', 0.3, 2.9, 'Mâle', 'Écran Poudre', ['Insecte']],
            [11, 'Chrysacier', ' En attendant sa prochaine évolution, il ne peut que durcir sa carapace et rester immobile pour éviter de se faire attaquer. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/11.png', 0.7, 9.9, 'Mâle', 'Mue', ['Insecte']],
            [12, 'Papilusion', ' Ce Pokémon raffole du nectar des fleurs. Il est capable de dénicher des champs fleuris même s’ils n’ont qu’une quantité infime de pollen. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/12.png', 1.1, 32.0, 'Femelle', 'Écran Poudre', ['Insecte', 'Vol']],
            [13, 'Aspicot', ' L’aiguillon sur son front est très pointu. Il se cache dans les bois et les hautes herbes, où il se gave de feuilles. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/13.png', 0.3, 3.2, 'Mâle', 'Écran Poudre', ['Insecte', 'Poison']],
            [14, 'Coconfort', ' Il peut à peine bouger. Quand il est menacé, il sort parfois son aiguillon pour empoisonner ses ennemis. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/14.png', 0.6, 10.0, 'Mâle', 'Mue', ['Insecte', 'Poison']],
            [15, 'Dardargnan', ' Il se sert de ses trois aiguillons empoisonnés situés sur les pattes avant et l’abdomen pour attaquer sans relâche ses adversaires. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/15.png', 1.0, 29.5, 'Femelle', 'Essaim', ['Insecte', 'Vol']],
            [16, 'Roucool', ' De nature très docile, il préfère projeter du sable pour se défendre plutôt que contre-attaquer. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/16.png', 0.3, 1.8, 'Mâle', 'Regard Vif', ['Normal', 'Vol']],
            [17, 'Roucoups', ' Ce Pokémon est très endurant. Il survole en permanence son territoire pour chasser. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/17.png', 1.1, 30.0, 'Mâle', 'Regard Vif', ['Normal', 'Vol']],
            [18, 'Roucarnage', ' Ce Pokémon vole à Mach 2 quand il chasse. Ses grandes serres sont des armes redoutables. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/18.png', 1.5, 39.5, 'Femelle', 'Regard Vif', ['Normal', 'Vol']],
            [19, 'Rattata', ' Il peut ronger n’importe quoi avec ses deux dents. Quand on en voit un, il y en a certainement 40 dans le coin. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/19.png', 0.3, 3.5, 'Mâle', 'Fuite', ['Normal']],
            [20, 'Rattatac', ' Ses pattes arrière sont palmées. Il peut donc poursuivre sa proie dans les cours d’eau et les rivières. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/20.png', 0.7, 18.5, 'Femelle', 'Fuite', ['Normal']],
            [21, 'Piafabec', ' Il est incapable de voler à haute altitude. Il se déplace très vite pour protéger son territoire. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/21.png', 0.3, 2.0, 'Mâle', 'Regard Vif', ['Normal', 'Vol']],
            [22, 'Rapasdepic', ' Un Pokémon très ancien. S’il perçoit un danger, il fuit instantanément à haute altitude. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/22.png', 1.2, 38.0, 'Femelle', 'Regard Vif', ['Normal', 'Vol']],
            [23, 'Abo', ' Sa mâchoire peut se désarticuler. Il est ainsi en mesure d’avaler de larges proies, mais ce faisant, il devient trop lourd pour bouger. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/23.png', 2.0, 6.9, 'Mâle', 'Intimidation', ['Poison']],
            [24, 'Arbok', ' Le motif sur son corps ressemble à un visage menaçant. Les adversaires les plus craintifs fuient à la seule vue de ce Pokémon. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/24.png', 3.5, 65.0, 'Femelle', 'Intimidation', ['Poison']],
            [25, 'Pikachu', ' Quand il s’énerve, il libère instantanément l’énergie emmagasinée dans les poches de ses joues. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/25.png', 0.4, 6.0, 'Mâle', 'Statik', ['Électrik']],
            [26, 'Raichu', ' Il se protège des décharges grâce à sa queue, qui dissipe l’électricité dans le sol. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/26.png', 0.8, 30.0, 'Femelle', 'Statik', ['Électrik']],
            [27, 'Sabelette', ' Il vit dans les profonds tunnels qu’il creuse. En cas de danger, il se roule en boule pour encaisser les coups de ses adversaires. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/27.png', 0.6, 12.0, 'Mâle', 'Voile Sable', ['Sol']],
            [28, 'Sablaireau', ' Il attaque en se déplaçant rapidement et blesse ses adversaires à l’aide des piques sur son dos et de ses griffes acérées. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/28.png', 1.0, 29.5, 'Femelle', 'Voile Sable', ['Sol']],
            [29, 'Nidoran♀', ' Son odorat est plus développé que celui du mâle. Quand Nidoran♀ cherche à manger, il reste dans le sens du vent, qu’il détecte avec ses vibrisses. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/29.png', 0.4, 7.0, 'Femelle', 'Point Poison', ['Poison']],
            [30, 'Nidorina', ' On pense que sa corne frontale s’est atrophiée pour lui permettre de nourrir ses petits sans les blesser. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/30.png', 0.8, 20.0, 'Femelle', 'Point Poison', ['Poison']],
            [31, 'Nidoran♂', '  Sa corne frontale contient un puissant poison. Les grandes oreilles de ce Pokémon très prudent sont constamment dressées.  ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/31.png', 0.5, 9.0, 'Mâle', 'Point Poison', ['Poison']],
            [32, 'Nidorino', ' Il erre à la recherche d’une Pierre Lune, brisant tous les rochers sur son passage avec sa corne plus solide qu’un diamant. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/32.png', 0.9, 19.5, 'Mâle', 'Point Poison', ['Poison']],
            [33, 'Nidoking', ' Lorsqu’il s’énerve, il devient incontrôlable, mais il retrouve son calme face à Nidoqueen, sa compagne de longue date. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/34.png', 1.4, 62.0, 'Mâle', 'Point Poison', ['Poison', 'Sol']],
            [34, 'Mélofée', ' Les Mélofée se rassemblent de toutes parts pour danser les nuits de pleine lune. Ils flottent dans les airs après avoir absorbé la lumière lunaire. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/35.png', 0.6, 7.5, 'Femelle', 'Joli Sourire', ['Fée']],
            [35, 'Mélodelfe', ' Ce Pokémon qui s’apparente à une fée déteste être vu. On dit qu’il vit dans le calme des montagnes reculées. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/36.png', 1.0, 40.0, 'Femelle', 'Joli Sourire', ['Fée']],
            [36, 'Goupix', ' S’il est attaqué par plus redoutable que lui, il feint la blessure et s’échappe à la première occasion. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/37.png', 0.6, 9.9, 'Mâle', 'Brasier', ['Feu']],
            [37, 'Feunard', ' Selon la légende, chacune de ses neuf queues posséderait un pouvoir magique unique. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/38.png', 1.1, 19.9, 'Mâle', 'Brasier', ['Feu']],
            [38, 'Rondoudou', ' Quand ses grands yeux luisent, il chante une berceuse mystérieuse et agréable qui pousse ses ennemis à s’endormir. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/39.png', 0.5, 5.5, 'Femelle', 'Joli Sourire', ['Normal', 'Fée']],
            [39, 'Grodoudou', ' Il a une très belle fourrure. Mieux vaut éviter de le mettre en colère, ou il gonflera avant d’attaquer de tout son corps. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/40.png', 1.2, 40.0, 'Femelle', 'Joli Sourire', ['Normal', 'Fée']],
            [40, 'Nosferapti', ' Il sonde les environs en émettant des ultrasons avec sa bouche, et peut ainsi se frayer un chemin même dans les grottes les plus étroites. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/41.png', 0.8, 7.5, 'Mâle', 'Lévitation', ['Poison', 'Vol']],
            [41, 'Nosferalto', ' Le sang des êtres vivants est son péché mignon. On dit qu’il partage parfois ce précieux breuvage avec ses congénères affamés. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/42.png', 1.6, 55.0, 'Mâle', 'Lévitation', ['Poison', 'Vol']],
            [42, 'Mystherbe', ' Son nom scientifique est « Têtkim Archus ». On dit que lorsqu’il fait nuit, il peut marcher sur plus de 300 mètres à l’aide de ses deux racines. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/43.png', 0.7, 5.4, 'Mâle', 'Chlorophylle', ['Plante', 'Poison']],
            [43, 'Ortide', ' Le liquide qui s’écoule lentement de sa bouche n’est pas de la bave, mais une sorte de nectar qu’il utilise pour appâter sa proie. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/44.png', 1.0, 12.5, 'Femelle', 'Chlorophylle', ['Plante', 'Poison']],
            [44, 'Rafflesia', ' Son bourgeon éclot en détonant. Il se met ensuite à disperser du pollen empoisonné qui provoque des allergies. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/45.png', 1.2, 29.5, 'Femelle', 'Chlorophylle', ['Plante', 'Poison']],
            [45, 'Paras', ' Il s’enfouit pour ronger des racines, mais ce sont les champignons sur son dos qui absorbent presque tous les nutriments. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/46.png', 0.3, 5.4, 'Mâle', 'Champi', ['Insecte', 'Plante']],
            [46, 'Parasect', ' À force de voir son énergie aspirée, il semblerait que ce ne soit plus l’insecte qui réfléchisse, mais le champignon sur son dos. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/47.png', 1.0, 29.5, 'Mâle', 'Champi', ['Insecte', 'Plante']],
            [47, 'Mimitoss', ' Son corps sécrète un poison redoutable. La nuit, il capture de petits Pokémon Insecte attirés par la lumière. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/48.png', 0.3, 3.5, 'Mâle', 'Écran Poudre', ['Insecte', 'Poison']],
            [48, 'Aéromite', ' Ses ailes sont couvertes d’écailles poudreuses. À chaque battement d’ailes, il laisse tomber de la poudre hautement toxique. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/49.png', 1.2, 32.8, 'Mâle', 'Écran Poudre', ['Insecte', 'Poison']],
            [49, 'Taupiqueur', ' Ce Pokémon vit un mètre sous terre et se nourrit de racines. Il apparaît parfois à la surface. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/50.png', 0.8, 5.0, 'Mâle', 'Voile Sable', ['Sol']],
            [50, 'Triopikeur', ' Ses trois têtes pilonnent le sol pour le rendre friable et ainsi faciliter l’excavation. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/51.png', 1.1, 32.5, 'Mâle', 'Voile Sable', ['Sol']],
            [51, 'Miaouss', ' Il passe ses journées à dormir. La nuit venue, il patrouille sur son territoire, les yeux brillants. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/52.png', 0.4, 4.2, 'Mâle', 'Ramassage', ['Normal']],
            [52, 'Persian', ' Sa magnifique fourrure suscite l’admiration, mais il est difficile à apprivoiser en raison de son caractère rétif. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/53.png', 1.0, 32.0, 'Mâle', 'Ramassage', ['Normal']],
            [53, 'Psykokwak', ' Ce Pokémon a tout le temps la migraine. Quand la douleur devient trop intense, il se met à utiliser des pouvoirs mystérieux. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/54.png', 0.8, 19.6, 'Mâle', 'Torrent', ['Eau']],
            [54, 'Akwakwak', ' Quand il nage à vitesse maximale grâce à ses pattes palmées, son front se met à luire pour une raison inconnue. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/55.png', 1.6, 76.6, 'Mâle', 'Torrent', ['Eau']],
            [55, 'Férosinge', ' Il vit en groupe au sommet des arbres. S’il perd ses congénères de vue, la solitude le rend furieux. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/56.png', 0.5, 30.0, 'Mâle', 'Agitation', ['Combat']],
            [56, 'Colossinge', ' Il devient fou furieux s’il se sent observé et pourchasse tout être qui croise son regard. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/57.png', 1.8, 52.0, 'Mâle', 'Agitation', ['Combat']],
            [57, 'Caninos', ' Courageux et fidèle, il se dresse vaillamment devant ses ennemis même s’ils sont plus puissants que lui. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/58.png', 0.7, 19.0, 'Mâle', 'Brasier', ['Feu']],
            [58, 'Arcanin', ' Une vieille estampe montre que les êtres humains étaient fascinés par ses mouvements lorsqu’il courait dans les champs. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/59.png', 1.9, 155.0, 'Mâle', 'Brasier', ['Feu']],
            [59, 'Ptitard', ' La spirale sur son ventre est un organe interne qu’on voit à travers sa peau. Elle est encore plus visible lorsqu’il vient de manger. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/60.png', 0.4, 9.0, 'Mâle', 'Torrent', ['Eau']],
            [60, 'Têtarte', ' Ses deux pattes très développées lui permettent de vivre sur la terre ferme, mais pour une raison inconnue, il préfère le milieu aquatique. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/61.png', 0.8, 22.0, 'Mâle', 'Torrent', ['Eau']],
            [61, 'Tartard', ' Ce Pokémon sait bien nager en mettant tous ses muscles à contribution, mais étrangement, il préfère vivre sur la terre ferme. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/62.png', 1.6, 55.0, 'Mâle', 'Torrent', ['Eau', 'Combat']],
            [62, 'Abra', ' Le contenu de ses rêves influe sur les pouvoirs psychiques qu’il utilise dans son sommeil. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/63.png', 0.9, 19.5, 'Mâle', 'Synchro', ['Psy']],
            [63, 'Kadabra', ' Ses pouvoirs psychiques lui permettent de léviter en dormant. Il utilise alors sa queue très souple comme un oreiller. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/64.png', 1.3, 56.5, 'Mâle', 'Synchro', ['Psy']],
            [64, 'Alakazam', ' Doué d’une intelligence hors du commun, ce Pokémon serait capable de conserver tous ses souvenirs, de sa naissance jusqu’à sa mort. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/65.png', 1.5, 48.0, 'Mâle', 'Synchronisation', ['Psy']],
            [65, 'Machoc', ' Son corps est essentiellement composé de muscles. Même s’il fait la taille d’un petit enfant, il peut soulever 100 adultes avec ses bras. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/66.png', 0.8, 19.5, 'Mâle', 'Agitation', ['Combat']],
            [66, 'Machopeur', ' Son corps est si puissant qu’il lui faut une ceinture pour maîtriser sa force. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/67.png', 1.5, 70.5, 'Mâle', 'Agitation', ['Combat']],
            [67, 'Mackogneur', ' Ses quatre bras bougent si vite qu’on ne distingue pas leurs mouvements. Il est capable de porter mille coups en deux secondes. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/68.png', 1.6, 130.0, 'Mâle', 'Agitation', ['Combat']],
            [68, 'Chétiflor', ' S’il détecte un mouvement, il déploie immédiatement ses fines lianes dans cette direction. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/69.png', 0.4, 2.2, 'Mâle', 'Engrais', ['Plante', 'Poison']],
            [69, 'Boustiflor', ' Il sécrète à la fois de l’acide et un liquide qui neutralise ce dernier. L’acide qu’il produit ne le consume donc pas. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/70.png', 0.7, 4.0, 'Mâle', 'Engrais', ['Plante', 'Poison']],
            [70, 'Empiflor', ' Le parfum de nectar qu’il dégage lui permet d’attirer ses proies dans sa bouche. Ces dernières sont alors liquéfiées par un fluide acide. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/71.png', 1.0, 15.5, 'Mâle', 'Engrais', ['Plante', 'Poison']],
            [71, 'Tentacool', ' Quand la marée descend, on peut voir des Tentacool desséchés échoués sur le sable. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/72.png', 0.9, 45.5, 'Mâle', 'Absorb Eau', ['Eau', 'Poison']],
            [72, 'Tentacruel', ' Les Tentacruel se regroupent rarement en masse dans la mer, mais lorsque cela arrive, tous les Pokémon poissons alentour disparaissent. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/73.png', 1.6, 55.0, 'Mâle', 'Absorb Eau', ['Eau', 'Poison']],
            [73, 'Racaillou', ' Au repos, rien ne le distingue d’un caillou, mais si on lui marche dessus par mégarde, il s’énerve et agite ses poings. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/74.png', 0.4, 20.0, 'Mâle', 'Fermeté', ['Roche', 'Sol']],
            [74, 'Gravalanch', ' Ce Pokémon marche lentement, donc il se déplace en roulant. Il ne prête pas attention à ce qui se trouve sur sa route. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/75.png', 1.0, 105.0, 'Mâle', 'Fermeté', ['Roche', 'Sol']],
            [75, 'Grolem', ' Il est recouvert d’une carapace aussi dure et rugueuse que la roche. Il s’en débarrasse une fois par an pendant sa mue pour pouvoir grandir. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/76.png', 1.4, 300.0, 'Mâle', 'Fermeté', ['Roche', 'Sol']],
            [76, 'Ponyta', ' Sa queue et sa crinière de feu splendides poussent une heure à peine après sa naissance. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/77.png', 1.0, 30.0, 'Mâle', 'Brasier', ['Feu']],
            [77, 'Galopa', ' Sa vitesse au galop est de 240 km/h. Les flammes de sa crinière brûlent intensément lorsqu’il file comme une flèche. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/78.png', 1.7, 95.0, 'Mâle', 'Brasier', ['Feu']],
            [78, 'Ramoloss', ' Ce Pokémon est très lent et apathique. Il lui faut cinq secondes pour ressentir la douleur provoquée par une attaque. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/79.png', 1.2, 36.0, 'Mâle', 'Absorb Eau', ['Eau', 'Psy']],
            [79, 'Flagadoss', ' Un jour, alors qu’un Ramoloss pêchait, un Kokiyas s’est accroché à sa queue et l’a fait évoluer en Flagadoss. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/80.png', 1.5, 78.5, 'Mâle', 'Absorb Eau', ['Eau', 'Psy']],
            [80, 'Magnéti', ' Les ondes électromagnétiques émises par ses extrémités lui permettent de défier les lois de la gravité et de flotter. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/81.png', 0.3, 6.0, 'Mâle', 'Statik', ['Électrik', 'Acier']],
            [81, 'Magnéton', ' Le lien magnétique qui rattache ces trois Magnéti est si puissant qu’il fait mal aux oreilles si on s’en approche trop. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/82.png', 0.9, 60.0, 'Mâle', 'Statik', ['Électrik', 'Acier']],
            [82, 'Canarticho', ' Il ne peut pas vivre sans sa tige, c’est pourquoi il la protège des ennemis au péril de sa vie. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/83.png', 1.1, 20.0, 'Mâle', 'Intimidation', ['Normal', 'Vol']],
            [83, 'Doduo', ' Ses deux têtes jumelles, dont les gènes sont strictement identiques, se battent de façon parfaitement synchronisée. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/84.png', 1.4, 39.2, 'Mâle', 'Fuite', ['Normal', 'Vol']],
            [84, 'Dodrio', ' Ce Pokémon possède à présent six poumons et trois cœurs. Il est plus lent que Doduo, mais il peut courir sur de plus longues distances. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/85.png', 1.8, 85.2, 'Mâle', 'Fuite', ['Normal', 'Vol']],
            [85, 'Otaria', ' La corne sur son front est très résistante. Elle lui sert à se frayer un chemin à travers les icebergs. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/86.png', 1.0, 29.5, 'Mâle', 'Absorb Eau', ['Eau']],
            [87, 'Lamantine', ' Le jour, il dort dans les eaux peu profondes. La nuit, quand la température de la mer descend, il part à la recherche de nourriture. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/88.png', 2.5, 120.0, 'Mâle', 'Absorb Eau', ['Eau', 'Glace']],
            [88, 'Tadmorv', ' Torrent de boue devenu Pokémon, il vit dans les lieux les plus insalubres pour que le nombre de microbes qu’il héberge augmente. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/89.png', 0.8, 30.0, 'Mâle', 'Point Poison', ['Poison']],
            [89, 'Grotadmorv', ' Ce Pokémon est recouvert d’une épaisse couche de boue crasseuse. Il est si toxique que même ses traces de pas sont empoisonnées. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/90.png', 1.2, 39.0, 'Mâle', 'Point Poison', ['Poison']],
            [90, 'Kokiyas', ' Une coquille plus dure que le diamant le protège. Il est toutefois étonnamment tendre à l’intérieur. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/91.png', 0.3, 2.3, 'Mâle', 'Armurbaston', ['Eau']],
            [91, 'Crustabri', ' Les Crustabri vivant dans des mers aux courants forts développent des dards particulièrement imposants et aiguisés sur leur coquille. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/92.png', 1.2, 52.5, 'Mâle', 'Armurbaston', ['Eau']],
            [92, 'Fantominus', ' Il enveloppe ses proies dans le nuage de gaz que forme son corps et les empoisonne à travers leur peau afin de les affaiblir petit à petit. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/93.png', 1.3, 1.5, 'Mâle', 'Lévitation', ['Spectre', 'Poison']],
            [93, 'Spectrum', ' Il adore se tapir dans l’ombre et faire frissonner ses proies pour l’éternité en leur touchant l’épaule. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/94.png', 1.5, 40.5, 'Mâle', 'Lévitation', ['Spectre', 'Poison']],
            [94, 'Ectoplasma', ' Il se cache dans l’ombre de sa victime et attend patiemment le bon moment pour lui voler sa vie. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/95.png', 1.6, 40.5, 'Mâle', 'Lévitation', ['Spectre', 'Poison']],
            [95, 'Onix', ' Il absorbe des éléments solides en creusant le sol, ce qui le rend plus robuste. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/96.png', 8.8, 210.0, 'Mâle', 'Tête de Roc', ['Roche', 'Sol']],
            [96, 'Soporifik', ' Ce Pokémon se souvient de tous les rêves qu’il a avalés. Il mange rarement les songes d’adultes, car ceux des enfants ont meilleur goût. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/97.png', 1.6, 32.0, 'Mâle', 'Insomnia', ['Psy']],
            [97, 'Hypnomade', ' Lorsqu’il croise le regard de son adversaire, il utilise de nombreux pouvoirs surnaturels comme l’hypnose. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/98.png', 2.2, 70.5, 'Mâle', 'Insomnia', ['Psy']],
            [98, 'Krabby', ' On trouve ce Pokémon près de la mer. Ses grosses pinces peuvent repousser si elles sont arrachées. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/99.png', 0.4, 6.5, 'Mâle', 'Armurbaston', ['Eau']],
            [99, 'Krabboss', ' Sa grande pince possède une puissance incommensurable, mais son poids la rend difficile à manier. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/100.png', 1.3, 60.0, 'Mâle', 'Armurbaston', ['Eau']],
            [100, 'Voltorbe', ' Il se déplace en roulant. Si le sol est cabossé, les chocs le font exploser. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/101.png', 0.5, 10.4, 'Mâle', 'Statik', ['Électrik']],
            [101, 'Électrode', ' Plus il accumule de l’énergie de type Électrik, plus il est rapide. Mais il a aussi davantage de chances d’exploser. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/102.png', 1.2, 66.6, 'Mâle', 'Statik', ['Électrik']],
            [102, 'Noeunoeuf', ' Ses têtes sont souvent prises pour des œufs. Si l’on en touche une, les autres se regroupent pour attaquer. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/103.png', 0.4, 1.9, 'Mâle', 'Coque Armure', ['Normal']],
            [103, 'Noadkoko', ' On le surnomme « la jungle ambulante ». Chacune de ses noix est dotée d’un visage et d’une volonté qui lui sont propres. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/104.png', 2.0, 75.0, 'Mâle', 'Chlorophylle', ['Plante', 'Vol']],
            [104, 'Osselait', ' Lorsqu’il repense à sa mère défunte, ses sanglots résonnent tristement sous le crâne qu’il porte sur la tête. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/105.png', 0.5, 15.0, 'Mâle', 'Fermeté', ['Sol']],
            [105, 'Ossatueur', ' Il s’est endurci et a évolué depuis qu’il a réussi à surmonter sa peine. Il utilise son os en guise d’arme et affronte ses ennemis avec bravoure. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/106.png', 1.4, 105.0, 'Mâle', 'Fermeté', ['Sol']],
            [106, 'Kicklee', ' Au moment de frapper sa cible, il durcit les muscles de la plante de son pied pour infliger un maximum de dégâts. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/107.png', 1.5, 49.8, 'Mâle', 'Joli Pied', ['Combat']],
            [107, 'Tygnon', ' Il accule ses adversaires en alternant des crochets du gauche et du droit, puis il les achève avec un coup direct dont la vitesse atteint les 500 km/h. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/108.png', 0.6, 21.0, 'Mâle', 'Joli Pied', ['Combat']],
            [108, 'Excelangue', ' Si sa salive gluante entre en contact avec la peau et qu’on ne l’essuie pas bien, elle provoque de terribles démangeaisons qui ne s’arrêtent jamais. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/109.png', 1.5, 65.5, 'Mâle', 'Ramassage', ['Normal']],
            [109, 'Smogo', ' Son corps très fin en forme de ballon est rempli de gaz toxiques qui provoquent parfois de violentes explosions. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/110.png', 1.2, 30.0, 'Mâle', 'Écran Poudre', ['Poison']],
            [110, 'Smogogo', ' En diluant au maximum les gaz toxiques que renferme son corps, on peut obtenir des parfums de premier choix. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/111.png', 1.6, 60.0, 'Mâle', 'Écran Poudre', ['Poison', 'Plante']],
            [111, 'Rhinocorne', ' Son territoire s’étend sur un rayon de 10 km, mais on raconte que lorsqu’il se met à courir, il oublie totalement où ce dernier se trouve. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/112.png', 1.0, 115.0, 'Mâle', 'Armurbaston', ['Sol', 'Roche']],
            [112, 'Rhinoféros', ' Il frappe sa corne contre celle de ses congénères afin de la renforcer. Celle-ci est assez robuste pour briser un diamant à l’état brut. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/113.png', 1.9, 120.0, 'Mâle', 'Armurbaston', ['Sol', 'Roche']],
            [113, 'Leveinard', ' Ce Pokémon très serviable distribue ses œufs hautement nutritifs aux êtres humains et aux Pokémon blessés. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/114.png', 1.1, 34.6, 'Femelle', 'Garde Magik', ['Normal']],
            [114, 'Saquedeneu', ' On ne sait toujours pas ce qui se cache sous ses lianes. Même si on les coupe, elles repoussent à l’infini. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/115.png', 0.6, 3.6, 'Mâle', 'Glissade', ['Plante']],
            [115, 'Kangourex', ' Porter son petit dans sa poche ventrale ne l’empêche pas d’avoir un bon jeu de jambes. Ses coups rapides intimident ses ennemis. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/116.png', 2.2, 80.0, 'Mâle', 'Esprit Vital', ['Normal']],
            [116, 'Hypotrempe', ' S’il est attaqué par des adversaires de grande taille, il s’enfuit en nageant agilement grâce à sa nageoire dorsale développée. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/117.png', 0.4, 8.0, 'Mâle', 'Torrent', ['Eau']],
            [117, 'Hypocéan', ' C’est le mâle qui élève les petits. Il repousse quiconque l’approche avec ses pointes empoisonnées. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/118.png', 1.0, 29.0, 'Mâle', 'Torrent', ['Eau']],
            [118, 'Poissirène', ' Ses nageoires dorsales, pectorales et caudales ondulent avec élégance. Il est surnommé le « danseur des flots ». ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/119.png', 0.6, 7.0, 'Mâle', 'Glissade', ['Eau']],
            [119, 'Poissoroy', ' En automne, à la saison des amours, il fait des réserves de graisse et arbore des couleurs chatoyantes. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/120.png', 1.5, 39.0, 'Mâle', 'Glissade', ['Eau']],
            [120, 'Stari', ' Lorsqu’on se rend en bord de mer à la fin de l’été, on peut voir des groupes de Stari clignoter à un rythme régulier. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/121.png', 0.8, 34.5, 'Mâle', 'Ramassage', ['Eau']],
            [121, 'Staross', ' S’il déchaîne son pouvoir psychique puissant, son organe appelé « cœur » se met à briller de sept couleurs. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/122.png', 1.1, 85.0, 'Mâle', 'Ramassage', ['Eau', 'Psy']],
            [122, 'M. Mime', ' Ce Pokémon est un expert de la pantomime. Les murs qu’il invente par ses gestes finissent par se matérialiser. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/122.png', 1.3, 54.5, 'Mâle', 'Synchronie', ['Psy', 'Fée']],
            [123, 'Insécateur', ' Il fauche les herbes avec ses lames acérées. Ses mouvements sont si rapides qu’ils sont imperceptibles à l’œil nu. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/123.png', 0.5, 5.0, 'Mâle', 'Essaim', ['Insecte', 'Vol']],
            [124, 'Lippoutou', ' Dans une certaine zone de Galar, Lippoutou était craint et vénéré par la population qui l’avait surnommé la « reine des glaces ». ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/124.png', 1.2, 44.0, 'Femelle', 'Intimidation', ['Glace', 'Psy']],
            [125, 'Élektek', ' Son corps libère constamment de l’électricité, si bien que les personnes qui s’approchent de lui voient leurs cheveux se dresser sur leur tête. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/125.png', 1.4, 30.0, 'Mâle', 'Statik', ['Électrik']],
            [126, 'Magmar', ' On trouve ce Pokémon cracheur de feu près des cratères des volcans. La température de son corps atteint les 1 200 °C. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/126.png', 1.3, 44.5, 'Mâle', 'Brasier', ['Feu']],
            [127, 'Scarabrute', ' Ses cornes déterminent son rang au sein du groupe. Plus elles sont imposantes, plus les membres du sexe opposé l’apprécient. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/127.png', 1.5, 55.0, 'Mâle', 'Essaim', ['Insecte', 'Vol']],
            [128, 'Tauros', ' Une fois qu’il a sa cible en vue, il la charge furieusement en fouettant son propre corps de sa triple queue. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/128.png', 1.4, 88.4, 'Mâle', 'Intimidation', ['Normal']],
            [129, 'Magicarpe', ' Un Pokémon tout à fait pathétique. En de très rares occasions, il est capable de sauter haut, mais jamais à plus de deux mètres. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/129.png', 0.9, 10.0, 'Mâle', 'Fuite', ['Eau']],
            [130, 'Léviator', ' Lorsqu’il apparaît, il saccage tout. Sa fureur ne se calme pas tant qu’il n’a pas tout détruit. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/130.png', 2.0, 235.0, 'Mâle', 'Intimidation', ['Eau', 'Vol']],
            [131, 'Lokhlass', ' Il traverse les mers en transportant les gens sur son dos. Il semblerait qu’il chante un air agréable quand il est de bonne humeur. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/131.png', 2.5, 220.0, 'Femelle', 'Absorb Eau', ['Eau', 'Glace']],
            [132, 'Métamorph', ' Il excelle dans l’art de la métamorphose, mais si on le fait rire, il ne pourra rester déguisé. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/132.png', 0.3, 4.0, 'Mâle', 'Mutualiste', ['Normal']],
            [133, 'Évoli', ' Ses multiples évolutions lui permettent de s’adapter à tout type de milieu naturel. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/133.png', 0.3, 6.5, 'Mâle', 'Adaptabilité', ['Normal']],
            [134, 'Aquali', ' Il vit au bord de l’eau. Sa queue semblable à celle d’un poisson lui donne l’apparence d’une sirène. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/134.png', 1.0, 29.0, 'Femelle', 'Absorb Eau', ['Eau']],
            [135, 'Voltali', ' Il concentre la faible charge électrique générée par chacune de ses cellules pour projeter de puissants éclairs. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/135.png', 0.8, 24.5, 'Mâle', 'Statik', ['Électrik']],
            [136, 'Pyroli', ' Sa glande enflammée chauffe l’air qu’il inspire. Il l’exhale ensuite sous forme de flamme atteignant les 1 700 °C. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/136.png', 0.9, 25.5, 'Femelle', 'Brasier', ['Feu']],
            [137, 'Porygon', ' Ce Pokémon artificiel ne respire pas. De grands espoirs reposent donc sur sa capacité à s’adapter à tous types d’environnements. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/137.png', 0.8, 36.5, 'Mâle', 'Télécharge', ['Normal']],
            [138, 'Amonita', ' Ce Pokémon commence à poser problème, car certains spécimens se sont enfuis ou ont été relâchés après avoir été ressuscités. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/138.png', 0.4, 7.5, 'Femelle', 'Coque Armure', ['Roche', 'Eau']],
            [139, 'Amonistar', ' Il se serait éteint à cause de la taille et du poids importants de sa coquille, qui le ralentissait quand il chassait ses proies. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/139.png', 1.0, 35.0, 'Mâle', 'Coque Armure', ['Roche', 'Eau']],
            [140, 'Kabuto', ' Ce Pokémon au bord de l’extinction mue tous les trois jours et renforce ainsi davantage sa carapace. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/140.png', 0.5, 11.5, 'Mâle', 'Coque Armure', ['Roche', 'Eau']],
            [141, 'Kabutops', ' Il lacère sa proie pour boire ses fluides corporels, puis jette son corps en pâture à d’autres Pokémon. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/141.png', 1.3, 40.5, 'Mâle', 'Coque Armure', ['Roche', 'Eau']],
            [142, 'Ptéra', ' On raconte qu’aujourd’hui encore, il est impossible de restaurer à la perfection ce Pokémon féroce de l’ère préhistorique. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/142.png', 1.8, 59.0, 'Mâle', 'Lévitation', ['Roche', 'Vol']],
            [143, 'Ronflex', ' Quand il ne dort pas, ce glouton passe son temps à manger. Il peut ingurgiter jusqu’à 400 kg de nourriture en une seule journée. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/143.png', 2.1, 460.0, 'Mâle', 'Isograisse', ['Normal']],
            [144, 'Artikodin', ' Ce Pokémon oiseau légendaire peut provoquer des blizzards en gelant l’humidité de l’air. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/144.png', 1.7, 55.4, 'Femelle', 'Pression', ['Glace', 'Vol']],
            [145, 'Électhor', ' Un Pokémon légendaire qui vivrait dans les nuages orageux. Il contrôle la foudre. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/145.png', 1.6, 52.6, 'Mâle', 'Pression', ['Électrik', 'Vol']],
            [146, 'Sulfura', ' L’un des Pokémon oiseaux légendaires. On dit que sa venue annonce l’arrivée du printemps. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/146.png', 2.0, 60.0, 'Femelle', 'Pression', ['Feu', 'Vol']],
            [147, 'Minidraco', ' Ce Pokémon grandit en muant à répétition. Lors de ce processus, il s’abrite derrière une puissante cascade. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/147.png', 0.3, 8.0, 'Mâle', 'Intimidation', ['Dragon']],
            [148, 'Draco', ' On dit que lorsque tout son corps émet une aura, les conditions climatiques se mettent à changer à vue d’œil. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/148.png', 1.1, 16.5, 'Mâle', 'Intimidation', ['Dragon']],
            [149, 'Dracolosse', ' On dit qu’il existe une île quelque part dans l’océan où ces Pokémon se réunissent pour vivre paisiblement. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/149.png', 2.3, 210.0, 'Femelle', 'Intimidation', ['Dragon', 'Vol']],
            [150, 'Mewtwo', ' Son ADN est presque le même que celui de Mew, mais sa taille et son caractère sont très différents. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/150.png', 2.0, 122.0, 'Mâle', 'Pression', ['Psy']],
            [151, 'Mew', ' À l’aide d’un microscope, on peut distinguer le pelage extrêmement court, fin et délicat de ce Pokémon. ', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/151.png', 0.4, 4.0, 'Femelle', 'Synchronie', ['Psy']],
        ];


        foreach ($pokemons as [$pokedexId, $name, $description, $imgSrc, $size, $weight, $sex, $talentName, $typeNames]) {
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
        }

        $manager->flush();
    }
}
