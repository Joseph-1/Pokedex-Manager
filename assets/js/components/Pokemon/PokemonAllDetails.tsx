import React, { useState, useEffect } from "react";
// On utilise le hook useParams de react-router-dom pour récupérer dynamiquement les paramètres de l'URL
import { useParams } from "react-router-dom";
import { Pokemon } from "../../../types/Pokemon";
import {fetchPokemonDetails} from "../../api/pokemonDetailsApi";
import {QuestionMarkCircleIcon} from "@heroicons/react/24/solid";

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
        <div className="p-4">
            <h1 className="text-3xl font-bold">{pokemonDetails.name}</h1>
            <h3 className="text-md font-semibold mb-4">#{pokemonDetails.pokedexId}</h3>
            <img src={pokemonDetails.imgSrc} alt={pokemonDetails.name}/>
            <p className="mb-2">Type : {pokemonDetails.type}</p>
            <p className="mb-2">Size : {pokemonDetails.size} m</p>
            <p className="mb-2">Weight : {pokemonDetails.weight} kg</p>
            <p className="mb-2">Sex : {pokemonDetails.sex}</p>
            <div className="mb-2 flex items-center">
                <p className="mr-2">Talent : {pokemonDetails.talent.name} </p>
                <div className="group relative">
                    <QuestionMarkCircleIcon className="w-6 h-6 text-gray-800 cursor-pointer" />

                    {/* Tooltip pour affichage de la description du talent au survol de l'icône */}
                    <div className="absolute left-1/2 -translate-x-1/2 bottom-full mb-2 w-64 p-2 text-sm
                        text-white bg-gray-800 rounded-lg opacity-0 scale-95 group-hover:opacity-100
                        group-hover:scale-100 transition-all duration-200 z-50">
                        {pokemonDetails.talent.description}
                    </div>
                </div>
            </div>
        </div>
    );

}
