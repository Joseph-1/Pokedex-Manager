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
            <p>Type :  {pokemon.type}</p>
        </div>
    );
}
