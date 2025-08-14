import React, { useState, useEffect } from 'react';
import { fetchPokemons } from '../../api/pokemonApi';
import PokemonCard from './PokemonCard';
import PokemonModal from './PokemonModal';
import SearchBar from './PokemonSearchBar';
import type { Pokemon } from '../../../types/Pokemon';


export default function PokemonList() {
    const [pokemons, setPokemons] = useState<Pokemon[]>([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);
    const [selectedPokemon, setSelectedPokemon] = useState<Pokemon | null>(null);
    const closeModal = () => setSelectedPokemon(null);
    const [searchTerm, setSearchTerm] = useState('');
    const filteredPokemons = pokemons.filter(pokemon =>
        pokemon.name.toLowerCase().includes(searchTerm.toLowerCase())
    );

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


    if (loading) return <p>Chargement...</p>;
    if (error) return <p>Erreur:  {error}</p>;

    // Sinon, on affiche la liste des Pokemons en appelant PokemonCard pour chacun
    return (
    <div>
        <SearchBar value={searchTerm} onChange={setSearchTerm} />

        <div className="pokedex-grid">
            {filteredPokemons.map((pokemon) => (
                <div key={pokemon.id} onClick={() => setSelectedPokemon(pokemon)}>
                    <PokemonCard pokemon={pokemon} />
                </div>
            ))}
        </div>

        {selectedPokemon && (
            <PokemonModal
                pokemon={selectedPokemon}
                onClose={closeModal}
            />
        )}
    </div>
    );
}
