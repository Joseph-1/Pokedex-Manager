import React from 'react';
import type { Pokemon } from '../../../types/Pokemon';
import { typeStyles } from "../../utils/typeStyles";

type Props = {
    pokemon: Pokemon; // le composant attend un objet Pokemon en prop
};

export default function PokemonCard({ pokemon }: Props) {
    return (
        <div className="pokemon-card bg-white rounded-xl shadow-md p-4 text-center transition-transform transform
        hover:-translate-y-1 hover:shadow-lg duration-300">
            <h2 className="text-lg font-bold text-gray-800">{pokemon.name}</h2>
            <h3 className="text-sm text-gray-500 mb-2">#{pokemon.pokedexId}</h3>
            <img
                src={pokemon.imgSrc}
                alt={pokemon.name}
                className="mx-auto w-24 h-24 mb-2"
            />
            <div className="flex flex-wrap justify-center gap-2 mt-1">
                {pokemon.types && pokemon.types.length > 0 ? (
                    pokemon.types.map((type) => (
                        <span
                            key={type.id}
                            className={
                                typeStyles[type.name] ||
                                "bg-gray-400 text-white px-2 py-1 rounded-full text-sm font-medium"
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
