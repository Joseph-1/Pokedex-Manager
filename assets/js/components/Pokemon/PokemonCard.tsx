import React from 'react';
import type { Pokemon } from '../../../types/Pokemon';

type Props = {
    pokemon: Pokemon; // le composant attend un objet Pokemon en prop
};

export default function PokemonCard({ pokemon }: Props) {
    return (
        <div className="pokemon-card">
            <img src={pokemon.imgSrc} alt={pokemon.name} />
            <h3>{pokemon.name}</h3>
            <p>Type : {pokemon.type}</p>
        </div>
    );
}
