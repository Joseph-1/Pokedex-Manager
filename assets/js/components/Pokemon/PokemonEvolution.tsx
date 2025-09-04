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
        <div className="pokemon-evolutions flex items-center justify-center gap-8 py-6">
            {/* Pré-évolutions */}
            {pokemon.preEvolutions && pokemon.preEvolutions.length > 0 && (
                <>
                    {pokemon.preEvolutions.map((pre) => (
                        <Link
                            key={pre.id}
                            to={`/pokemon/${pre.id}`}
                            className="group text-center flex flex-col items-center transition-transform
                            hover:scale-105"
                        >
                            <div className="relative w-20 h-20 rounded-full bg-white/70 backdrop-blur-md shadow-md
                            flex items-center justify-center border border-white/30 overflow-hidden">
                                <img src={pre.imgSrc} alt={pre.name} className="w-16 h-16 object-contain" />
                            </div>
                            <p className="text-sm font-medium text-gray-800 mt-2 group-hover:text-indigo-500
                            transition-colors">
                                {pre.name}
                            </p>
                        </Link>
                    ))}

                    {/* Flèche entre les évolutions */}
                    <span className="text-2xl text-gray-500">➝</span>
                </>
            )}

            {/* Pokémon actuel */}
            <div className="text-center flex flex-col items-center">
                <div className="relative w-24 h-24 rounded-full bg-gradient-to-br from-indigo-500/80 to-pink-500/80
                    backdrop-blur-md shadow-xl flex items-center justify-center border border-white/40
                    overflow-hidden">
                    <img src={pokemon.imgSrc} alt={pokemon.name} className="w-20 h-20 object-contain" />
                </div>
                <p className="text-lg font-semibold text-gray-900 mt-2">{pokemon.name}</p>
            </div>

            {/* Évolutions */}
            {allEvolutions.length > 0 && (
                <>
                    <span className="text-2xl text-gray-500">➝</span>

                    {allEvolutions.map((evolution) => (
                        <Link
                            key={evolution.id}
                            to={`/pokemon/${evolution.id}`}
                            className="group text-center flex flex-col items-center transition-transform hover:scale-105"
                        >
                            <div className="relative w-20 h-20 rounded-full bg-white/70 backdrop-blur-md shadow-md
                            flex items-center justify-center border border-white/30 overflow-hidden">
                                <img src={evolution.imgSrc} alt={evolution.name} className="w-16 h-16 object-contain" />
                            </div>
                            <p className="text-sm font-medium text-gray-800 mt-2 group-hover:text-indigo-500
                            transition-colors">
                                {evolution.name}
                            </p>
                        </Link>
                    ))}
                </>
            )}
        </div>
    );
}
