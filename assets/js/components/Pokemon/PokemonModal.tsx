import React, { useState, useEffect } from "react";
import { Pokemon } from "../../../types/Pokemon";
import {fetchPokemonDetails} from "../../api/pokemonDetailsApi";

type Props = {
    pokemon: Pokemon;
    onClose: () => void;
};

export default function PokemonModal({ pokemon, onClose }: Props) {
    const [pokemonDetails, setPokemonDetails] = useState<Pokemon | null>(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        if (!pokemon?.id) return;

        setLoading(true);
        // On indique bien de fetch l'id du pokemon
        fetchPokemonDetails(pokemon.id)
            .then(data => {
                console.log(data)
                setPokemonDetails(data);
                setLoading(false);
            })
            .catch(err => {
                setError(err.message);
                setLoading(false)
            });
    }, [pokemon]);

    if (loading) return <p>Chargement...</p>;
    if (error) return <p>Erreur:  {error}</p>
    if (!pokemonDetails) return null;

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
                <h2 className="text-xl font-bold mb-2 text-center">{pokemonDetails.name}</h2>
                <h3 className="text-md font-semibold mb-4 text-center">#{pokemonDetails.pokedexId}</h3>
                <img src={pokemonDetails.imgSrc} alt={pokemonDetails.name}/>
                <p className="mb-2">Type : {pokemonDetails.type}</p>
                <p className="mb-2">Size : {pokemonDetails.size} m</p>
                <p className="mb-2">Weight : {pokemonDetails.weight} kg</p>
                <p className="mb-2">Sex : {pokemonDetails.sex}</p>
                <p className="mb-2">Talent : {pokemonDetails.talent.name}</p>
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
