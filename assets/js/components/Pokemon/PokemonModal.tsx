import React from "react";
import { Pokemon } from "../../../types/Pokemon";

type Props = {
    pokemon: Pokemon;
    onClose: () => void;
};

export default function PokemonModal({ pokemon, onClose }: Props) {
    return (
        // Overlay sombre
        <div
            className="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50"
            onClick={onClose}
        >
            <div
                className="bg-white rounded-lg shadow-lg p-6 w-80 max-w-full"
                // "(e) => e.stopPropagation()" :  Bloque la propagation du clic
                onClick={(e) => e.stopPropagation()}
            >
                <h2 className="text-xl font-bold mb-2 text-center">{pokemon.name}</h2>
                <h3 className="text-md font-semibold mb-4 text-center">#{pokemon.pokedexId}</h3>
                <img
                    src={pokemon.imgSrc}
                    alt={pokemon.name}
                    className="mx-auto mb-4 w-40 h-40 object-contain"
                />
                <p className="mb-2">Type : {pokemon.type}</p>
                <p className="mb-2">Size : {pokemon.size}</p>
                <p className="mb-2">Weight : {pokemon.weight}</p>
                <p className="mb-2">Sex : {pokemon.sex}</p>
                <button
                    onClick={onClose}
                    className="mt-4 w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded"
                >
                    Fermer
                </button>
            </div>
        </div>
    );
}
