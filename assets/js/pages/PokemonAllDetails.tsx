import React, { useState, useEffect } from "react";
// On utilise le hook useParams de react-router-dom pour récupérer dynamiquement les paramètres de l'URL
import { useParams } from "react-router-dom";
import { Pokemon } from "../../types/Pokemon";
import {fetchPokemonDetails} from "../api/pokemonDetailsApi";
import {QuestionMarkCircleIcon} from "@heroicons/react/24/solid";
import {typeStyles} from "../utils/typeStyles";
import PokemonEvolution from "../components/Pokemon/PokemonEvolution";

export default function PokemonAllDetails() {
    // Permet de récupérer le paramètre id de l'URL
    const { id } = useParams<{ id: string}>();
    const [pokemonDetails, setPokemonDetails] = useState<Pokemon | null>(null);

    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);

    // On fetch directement via l'id en paramètre grâce au useParams
    useEffect(() => {
        if (!id) return; // pas d'id, on ne fait rien

        // Conversion en nombre, car fetchPokemonDetails attend un nombre et useParams renvoie un string
        const numericId = parseInt(id, 10)

        setLoading(true);

        fetchPokemonDetails(numericId)
            .then(data => {
                setPokemonDetails(data);
                console.log(data)
                setLoading(false);
            })
            .catch(err => {
                setError(err.message);
                setLoading(false);
            });
    }, [id]);

    if (loading) return <p>Chargement...</p>;
    if (error) return <p>Erreur:  {error}</p>

    return (
        <div className="p-6 max-w-5xl mx-auto">
            {/* Header Pokémon */}
            <div className="bg-white/90 backdrop-blur-sm rounded-2xl shadow-lg p-6 text-center relative overflow-hidden mb-8 border border-white/20">
                {/* Glow décoratif */}
                <div className="absolute inset-0">
                    <div className="w-40 h-40 bg-white/20 rounded-full blur-3xl absolute -top-10 -left-10"></div>
                    <div className="w-32 h-32 bg-white/10 rounded-full blur-2xl absolute bottom-0 right-0"></div>
                </div>

                <h1 className="text-4xl font-bold text-gray-900 relative z-10">{pokemonDetails.name}</h1>
                <h3 className="text-lg text-gray-700 mb-4 relative z-10">#{pokemonDetails.pokedexId}</h3>

                <img
                    src={pokemonDetails.imgSrc}
                    alt={pokemonDetails.name}
                    className="mx-auto w-40 h-40 relative z-10"
                />

                {/* Types */}
                <div className="flex flex-wrap justify-center gap-2 mt-4 relative z-10">
                    {pokemonDetails.types && pokemonDetails.types.length > 0 ? (
                        pokemonDetails.types.map((type) => (
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

            {/* Infos + Evolutions */}
            <div className="grid md:grid-cols-2 gap-6">
                {/* Infos */}
                <div className="bg-white/80 backdrop-blur-sm rounded-2xl shadow p-6 border border-white/20">
                    <h2 className="text-xl font-semibold mb-4 text-gray-900">Informations</h2>
                    <p className="mb-3 text-gray-700"><span className="font-medium">Description :</span> {pokemonDetails.description}</p>
                    <p className="mb-2 text-gray-700"><span className="font-medium">Taille :</span> {pokemonDetails.size} m</p>
                    <p className="mb-2 text-gray-700"><span className="font-medium">Poids :</span> {pokemonDetails.weight} kg</p>
                    <p className="mb-2 text-gray-700"><span className="font-medium">Sexe :</span> {pokemonDetails.sex}</p>

                    <div className="mb-2 flex items-center">
                        <p className="mr-2 text-gray-700"><span className="font-medium">Talent :</span> {pokemonDetails.talent.name}</p>
                        <div className="group relative">
                            <QuestionMarkCircleIcon className="w-6 h-6 text-gray-800 cursor-pointer" />
                            <div className="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 w-64 p-2 text-sm
            text-white bg-gray-800 rounded-lg opacity-0 scale-95 group-hover:opacity-100
            group-hover:scale-100 transition-all duration-200 z-50">
                                {pokemonDetails.talent.description}
                            </div>
                        </div>
                    </div>
                </div>

                {/* Evolutions */}
                <div className="bg-white/80 backdrop-blur-sm rounded-2xl shadow p-6 border border-white/20">
                    <h2 className="text-xl font-semibold mb-4 text-gray-900">Évolutions</h2>
                    <PokemonEvolution pokemon={pokemonDetails} />
                </div>
            </div>
        </div>
    );

}
