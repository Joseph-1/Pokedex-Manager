import React from 'react';
import type { Pokemon } from '../../../types/Pokemon';

type Props = {
    pokemon: Pokemon; // le composant attend un objet Pokemon en prop
};

export default function PokemonCard({ pokemon }: Props) {
    return (
        <div className="pokemon-card">
            <h2>{pokemon.name}</h2>
            <h2>#{pokemon.pokedexId}</h2>
            <img src={pokemon.imgSrc} alt={pokemon.name} className="pokemon-image" />
            <p className="mt-2 font-semibold">Types :</p>
            <div className="flex flex-wrap gap-2 mt-1">
                {pokemon.types && pokemon.types.length > 0 ? (
                    pokemon.types.map(type => (
                        <span
                            key={type.id}
                            className="px-2 py-1 rounded text-white text-sm font-medium"
                            style={{ backgroundColor: type.style || '#999' }} // Utilise style depuis la BDD ou gris par défaut
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
