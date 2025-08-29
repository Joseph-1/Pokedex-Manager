import React from 'react';
import { Link } from 'react-router-dom';
import type { Pokemon } from '../../../types/Pokemon';

type Props = {
    pokemon: Pokemon;
};

export default function PokemonEvolutions({ pokemon }: Props) {
    // Fonction récursive pour récupérer toutes les évolutions en chaîne
    const getAllEvolutions = (poke) => {
        if (!poke?.evolutions) return []; // retourne un tableau vide si aucune évolution

        let evolutions: Pokemon[] = [];
        poke.evolutions.forEach((e) => {
            evolutions.push(e);
            if (e.evolutions && e.evolutions.length > 0) {
                evolutions = evolutions.concat(getAllEvolutions(e));
            }
        });

        return evolutions;
    };

    const allEvolutions = getAllEvolutions(pokemon);

    return (
        <div className="pokemon-evolutions flex items-center gap-6">
            {/* Pré-évolutions */}
            {pokemon.preEvolutions && pokemon.preEvolutions.length > 0 && (
                <>
                    {pokemon.preEvolutions.map(pre => (
                        <Link key={pre.id} to={`/pokemon/${pre.id}`} className="text-center flex flex-col items-center">
                            <img src={pre.imgSrc} alt={pre.name} className="w-16 h-16" />
                            <p className="text-sm">{pre.name}</p>
                        </Link>
                    ))}
                    <span className="text-lg font-bold"></span>
                </>
            )}

            {/* Pokémon actuel */}
            <div className="text-center flex flex-col items-center">
                <img src={pokemon.imgSrc} alt={pokemon.name} className="w-20 h-20" />
                <p className="text-lg font-medium">{pokemon.name}</p>
            </div>

            {/* Évolutions */}
            {allEvolutions.length > 0 && (
                <>
                    <span className="text-lg font-bold"></span>
                    {allEvolutions.map(evolution => (
                        <Link key={evolution.id} to={`/pokemon/${evolution.id}`} className="text-center flex flex-col items-center">
                            <img src={evolution.imgSrc} alt={evolution.name} className="w-16 h-16" />
                            <p className="text-sm">{evolution.name}</p>
                        </Link>
                    ))}
                </>
            )}
        </div>

    );
}
