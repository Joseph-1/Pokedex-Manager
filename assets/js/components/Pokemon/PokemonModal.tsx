import React, { useState, useEffect } from "react";
import { Pokemon } from "../../../types/Pokemon";
import {fetchPokemonDetails} from "../../api/pokemonDetailsApi";
import { QuestionMarkCircleIcon } from '@heroicons/react/24/solid';
// Link composant React qui permet de créer des liens de navigations internes
import { Link } from "react-router-dom";
import {typeStyles} from "../../utils/typeStyles";

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
        <div
            className="fixed inset-0 bg-black/50 backdrop-blur-sm flex justify-center items-center z-50"
            onClick={onClose}
        >
            <div
                className="relative bg-white/80 backdrop-blur-xl rounded-2xl shadow-2xl p-6 w-96 max-w-[90%]
               border border-white/30 transform transition-all animate-fadeIn"
                onClick={(e) => e.stopPropagation()}
            >
                {/* Bouton de fermeture en haut à droite */}
                <button
                    onClick={onClose}
                    className="absolute top-3 right-3 text-gray-600 hover:text-indigo-500 transition-colors"
                >
                    ✕
                </button>

                {/* Image */}
                <div className="flex flex-col items-center">
                    <img
                        src={pokemonDetails.imgSrc}
                        alt={pokemonDetails.name}
                        className="w-32 h-32 mb-4 drop-shadow-lg"
                    />
                    <h2 className="text-2xl font-bold text-gray-900">{pokemonDetails.name}</h2>
                    <h3 className="text-gray-600 mb-4">#{pokemonDetails.pokedexId}</h3>
                </div>

                {/* Infos principales */}
                <div className="space-y-2 text-gray-800">
                    <div className="flex flex-wrap justify-center gap-2 mt-1 mb-2 relative z-10">
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
                    <p><span className="font-semibold">Taille :</span> {pokemonDetails.size} m</p>
                    <p><span className="font-semibold">Poids :</span> {pokemonDetails.weight} kg</p>
                    <p><span className="font-semibold">Sexe :</span> {pokemonDetails.sex}</p>
                    <div className="flex items-center">
                        <span className="font-semibold mr-2">Talent :</span>
                        <span>{pokemonDetails.talent.name}</span>

                        {/* Tooltip */}
                        <div className="group relative ml-2">
                            <QuestionMarkCircleIcon className="w-5 h-5 text-gray-700 cursor-pointer" />
                            <div className="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 w-64 p-2 text-sm
                          text-white bg-gray-800/90 rounded-lg opacity-0 scale-95 group-hover:opacity-100
                          group-hover:scale-100 transition-all duration-200 z-50 shadow-lg">
                                {pokemonDetails.talent.description}
                            </div>
                        </div>
                    </div>
                </div>

                {/* Boutons */}
                <div className="mt-6 flex flex-col gap-2">
                    <Link
                        to={`/pokemon/${pokemon.id}`}
                        className="w-full text-center bg-indigo-500 hover:bg-indigo-600 text-white
                        font-semibold py-2 px-4 rounded-lg shadow-md transition-colors"
                    >
                        Voir la fiche complète
                    </Link>
                    <Link
                        to={`/pokemon/${pokemon.id}/edit`}
                        className="w-full text-center bg-gray-200 hover:bg-gray-300 text-gray-800
                        font-semibold py-2 px-4 rounded-lg transition-colors"
                    >
                        Modifier
                    </Link>
                </div>
            </div>
        </div>
    );
}
