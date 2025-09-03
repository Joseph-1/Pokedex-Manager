import React from 'react';
import type { Pokemon } from '../../../types/Pokemon';
import { typeStyles } from "../../utils/typeStyles";

type Props = {
    pokemon: Pokemon; // le composant attend un objet Pokemon en prop
};

export default function PokemonCard({ pokemon }: Props) {
    return (
        <div className="pokemon-card bg-white/90 backdrop-blur-sm bg-gradient-to-br from-white/20 to-white/10 rounded-2xl
        shadow-lg p-4 text-center transition-transform transform hover:-translate-y-2 hover:shadow-2xl duration-300
        border border-white/20 relative overflow-hidden">
            <div className="absolute top-0 left-0 w-full h-full pointer-events-none">
                <div className="w-32 h-32 bg-white/20 rounded-full blur-3xl animate-pulse absolute -top-10 -left-10"></div>
                <div className="w-24 h-24 bg-white/10 rounded-full blur-2xl animate-pulse absolute -bottom-5 -right-5"></div>
            </div>

            <h2 className="text-lg font-bold text-gray-900 relative z-10">{pokemon.name}</h2>
            <h3 className="text-sm text-gray-700 mb-2 relative z-10">#{pokemon.pokedexId}</h3>
            <img
                src={pokemon.imgSrc}
                alt={pokemon.name}
                className="mx-auto w-28 h-28 mb-2 relative z-10"
            />
            <div className="flex flex-wrap justify-center gap-2 mt-1 relative z-10">
                {pokemon.types && pokemon.types.length > 0 ? (
                    pokemon.types.map((type) => (
                        <span
                            key={type.id}
                            className={
                                typeStyles[type.name] ||
                                "bg-gray-500/50 text-white px-3 py-1 rounded-full text-sm font-medium backdrop-blur-sm"
                            }
                        >
                    {type.name}
                </span>
                    ))
                ) : (
                    <span className="text-gray-400">Aucun</span>
                )}
            </div>
        </div>
    );
}
