import React, { useState, useEffect } from 'react';
import { fetchPokemons } from '../../api/pokemonApi';
import PokemonCard from './PokemonCard';
import type { Pokemon } from '../../../types/Pokemon';


export default function PokemonList() {
    const [pokemons, setPokemons] = useState<Pokemon[]>([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);
    const [selectedPokemon, setSelectedPokemon] = useState<Pokemon | null>(null);

    useEffect(() => {
        // Appeler la fonction fetchPokemons qui fait la requête à l’API Symfony
        fetchPokemons()
            .then(data => {
                // Si succès, stocker les données reçues dans le state 'pokemons'
                setPokemons(data);
                setLoading(false);
            })
            .catch(err => {
                // En cas d’erreur (réseau, serveur, etc), stocker le message d’erreur
                setError(err.message);
                setLoading(false);
            });
    }, []); // La dépendance vide [] signifie que cet effet ne tourne qu’une fois au montage

    const closeModal = () => setSelectedPokemon(null);

    if (loading) return <p>Chargement...</p>;

    if (error) return <p>Erreur : {error}</p>;

    // Sinon, on affiche la liste des Pokemons en appelant PokemonCard pour chacun
    return (
    <div>
        <div className="pokedex-grid">
            {pokemons.map((pokemon) => (
                <div key={pokemon.id} onClick={() => setSelectedPokemon(pokemon)}>
                    <PokemonCard pokemon={pokemon} />
                </div>
            ))}
        </div>

        {selectedPokemon && (
            <div
                className="pokemon-modal"
                onClick={closeModal} // Clic sur le fond
            >
                <div
                    className="pokemon-modal-content"
                    // "(e) => e.stopPropagation()" :  Bloque la propagation du clic
                    onClick={(e) => e.stopPropagation()}
                >
                    <h2>{selectedPokemon.name} #{selectedPokemon.pokedexId}</h2>
                    <img src={selectedPokemon.imgSrc} alt={selectedPokemon.name} />
                    <p>Type : {selectedPokemon.type}</p>
                    <p>Taille : {selectedPokemon.size} m</p>
                    <p>Poids : {selectedPokemon.weight} kg</p>
                    <p>Sexe : {selectedPokemon.sex}</p>
                    <button onClick={closeModal}>Fermer</button>
                </div>
            </div>
        )}
    </div>
);
}
