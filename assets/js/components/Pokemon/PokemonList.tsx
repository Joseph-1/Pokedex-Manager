import React, { useState, useEffect, useRef } from 'react';
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

    // --- Recherche par nom et par type ---
    const [searchTerm, setSearchTerm] = useState('');
    const filteredPokemons = pokemons.filter((p) => {
        const searchLower = searchTerm.toLowerCase();

        // Vérifie si le nom contient la recherche
        const matchesName = p.name.toLowerCase().includes(searchLower);

        // Vérifie si un type correspond
        const matchesType = p.types.some((t) =>
            t.name.toLowerCase().includes(searchLower)
        );

        return matchesName || matchesType;
    });
    /*
    // --- Recherche par nom uniquement ---
    const [searchTerm, setSearchTerm] = useState('');
    const filteredPokemons = pokemons.filter(pokemon =>
        pokemon.name.toLowerCase().includes(searchTerm.toLowerCase())
    );
     */

    // --- Pagination côté front ---
    const [displayCount, setDisplayCount] = useState(15); // On affiche 15 Pokémon au départ
    const [loadingMore, setLoadingMore] = useState(false);

    // --- Gestion du badge ---
    const badgeRef = useRef<HTMLDivElement | null>(null);

    // --- Récupération des Pokémon ---
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

    // --- Infinite scroll ---
    useEffect(() => {
        if (!badgeRef.current) return;

        const observer = new IntersectionObserver((entries) => {
            const entry = entries[0];
            if (entry.isIntersecting && displayCount < filteredPokemons.length && !loadingMore) {
                setLoadingMore(true);
                setTimeout(() => {
                    setDisplayCount(prev => Math.min(prev + 15, filteredPokemons.length));
                    setLoadingMore(false);
                }, 800);
            }
        }, {
            root: null,
            rootMargin: '0px',
            threshold: 1.0,
        });

        observer.observe(badgeRef.current);

        return () => observer.disconnect();
    }, [displayCount, filteredPokemons.length, loadingMore]);


    if (loading) return <p>Chargement...</p>;
    if (error) return <p>Erreur:  {error}</p>;

    return (
    <div>
        <SearchBar value={searchTerm} onChange={setSearchTerm} />

        <div className="pokedex-grid">
            {filteredPokemons.slice(0, displayCount).map((pokemon) => (
                <div key={pokemon.id} onClick={() => setSelectedPokemon(pokemon)}>
                    <PokemonCard pokemon={pokemon} />
                </div>
            ))}
        </div>

        {/* Badge visible sous les derniers Pokémon affiché */}
        {displayCount < filteredPokemons.length && (
            <div className="flex justify-center mt-4">
                <div
                    ref={badgeRef}
                    id="scroll-badge"
                    className="w-max bg-gradient-to-r from-indigo-200 via-purple-200 to-pink-200 text-gray-800
                    px-4 py-2 rounded-full shadow-md text-center animate-bounce"
                >
                    ⬇️ Défiler pour voir plus de Pokémon ⬇️
                </div>
            </div>
        )}

        {/* Gestion de la modal */}
        {selectedPokemon && (
            <PokemonModal
                pokemon={selectedPokemon}
                onClose={closeModal}
            />
        )}
    </div>
    );
}
