import React from "react";
import { Pokemon } from "../types/Pokemon";

type PokemonCardProps = {
    pokemon: Pokemon;
    onClick?: () => void; // Pour étape 6
};

export default function PokemonCard({ pokemon, onClick }: PokemonCardProps) {
    return (
        <div
            className="bg-white rounded-xl shadow-lg p-4 flex flex-col items-center w-60 hover:shadow-2xl cursor-pointer transition-shadow duration-300"
            onClick={onClick}
        >
            <h2 className="text-xl font-bold text-gray-800">{pokemon.name}</h2>
            <p className="text-gray-500">#{pokemon.pokedexId}</p>
            <span className="mt-2 px-3 py-1 rounded-full text-white bg-blue-500">
        {pokemon.type}
      </span>
        </div>
    );
}
