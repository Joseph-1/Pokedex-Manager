import React, { useState, useEffect } from 'react';
import { fetchPokemons } from '../../api/pokemonApi';
import PokemonCard from './PokemonCard';
import type { Pokemon } from '../../../types/Pokemon';


export default function PokemonList() {
    // useState pour stocker la liste des pokemons (initialement tableau vide)
    const [pokemons, setPokemons] = useState<Pokemon[]>([]);
    // useState pour gérer l’état de chargement (true au départ)
    const [loading, setLoading] = useState(true);
    // useState pour gérer l’erreur éventuelle (null au départ = pas d’erreur)
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        // Appeler la fonction fetchPokemons qui fait la requête à l’API Symfony
        fetchPokemons()
            .then(data => {
                // Si succès, stocker les données reçues dans le state 'pokemons'
                setPokemons(data);
                // Fin du chargement
                setLoading(false);
            })
            .catch(err => {
                // En cas d’erreur (réseau, serveur, etc), stocker le message d’erreur
                setError(err.message);
                // Fin du chargement même en cas d’erreur
                setLoading(false);
            });
    }, []); // La dépendance vide [] signifie que cet effet ne tourne qu’une fois au montage

    // Pendant que loading est true, on affiche un message de chargement
    if (loading) return <p>Chargement...</p>;

    // Si on a une erreur, on l’affiche
    if (error) return <p>Erreur : {error}</p>;

    // Sinon, on affiche la liste des Pokemons en appelant PokemonCard pour chacun
    return (
        <div className="pokedex-grid">
            {pokemons.map((pokemon) => (
                <PokemonCard key={pokemon.id} pokemon={pokemon} />
            ))}
        </div>
    );
}
