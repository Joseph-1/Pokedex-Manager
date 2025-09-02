// src/pages/PokemonEditFormPage.tsx
import { useEffect, useState } from 'react';
import { useParams, Link, useNavigate } from 'react-router-dom';
import {fetchPokemonDetails} from "../api/pokemonDetailsApi";
import { updatePokemon } from '../api/pokemonEditApi';
import { Pokemon } from "../../types/Pokemon";

export default function PokemonEditFormPage() {
    const { id } = useParams();
    const pokemonId = id ? parseInt(id, 10) : NaN;
    const navigate = useNavigate();

    const [pokemon, setPokemon] = useState<Pokemon | null>(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);

    // States pour l’édition du nom
    const [isEditingName, setIsEditingName] = useState(false);
    const [nameInput, setNameInput] = useState('');

    const [message, setMessage] = useState<string | null>(null);


    useEffect(() => {
        if (!pokemonId || Number.isNaN(pokemonId)) {
            setError('ID invalide');
            setLoading(false);
            return;
        }

        setLoading(true);
        fetchPokemonDetails(pokemonId)
            .then((data) => {
                setPokemon(data);
                setNameInput(data.name); // initialiser l’input avec le nom actuel
                setLoading(false);
            })
            .catch((err) => {
                setError(err.message || 'Erreur de chargement');
                setLoading(false);
            });
    }, [pokemonId]);

    // Actions d’édition
    const startEditName = () => {
        if (!pokemon) return;
        setNameInput(pokemon.name);
        setIsEditingName(true);
        setMessage(null);
    };

    const cancelEditName = () => {
        if (!pokemon) return;
        setNameInput(pokemon.name);
        setIsEditingName(false);
    };

    const saveName = async () => {
        if (!pokemon || !nameInput.trim()) return;

        try {
            const updated = await updatePokemon(pokemon.id, { name: nameInput.trim() });
            // on met à jour le state local avec le retour API
            setPokemon((prev) => (prev ? { ...prev, name: updated.name } : prev));
            setIsEditingName(false);
            setMessage('Nom mis à jour avec succès !');
        } catch (e: any) {
            setMessage(e.message || 'Erreur lors de la mise à jour');
        }
    };

    // Raccourcis clavier sur l’input (Entrée = sauvegarder, Échap = annuler)
    const onNameKeyDown: React.KeyboardEventHandler<HTMLInputElement> = (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            saveName();
        }
        if (e.key === 'Escape') {
            e.preventDefault();
            cancelEditName();
        }
    };

    if (loading) return <p className="p-4">Chargement…</p>;
    if (error) return <p className="p-4 text-red-600">Erreur : {error}</p>;
    if (!pokemon) return <p className="p-4">Pokémon introuvable</p>;

    return (
        <div className="max-w-2xl mx-auto p-4 space-y-6">
            <div className="flex items-center justify-between">
                <h1 className="text-xl font-semibold">Édition du Pokémon #{pokemon.pokedexId}</h1>
                <div className="space-x-2">
                    <Link to={`/pokemon/${pokemon.id}`} className="underline">
                        Voir la fiche
                    </Link>
                    <button
                        className="px-3 py-1 rounded border"
                        onClick={() => navigate(-1)}
                    >
                        ⟵ Retour
                    </button>
                </div>
            </div>

            <div className="flex items-center gap-4">
                {pokemon.imgSrc && (
                    <img
                        src={pokemon.imgSrc}
                        alt={pokemon.name}
                        className="w-24 h-24 object-contain"
                    />
                )}

                {/* Bloc Nom : affichage vs édition */}
                <div className="flex-1">
                    <label className="block text-sm text-gray-500 mb-1">Nom</label>

                    {!isEditingName ? (
                        <div className="flex items-center gap-3">
                            <p className="text-lg font-medium">{pokemon.name}</p>
                            <button
                                className="text-sm px-2 py-1 rounded border hover:bg-gray-50"
                                onClick={startEditName}
                            >
                                Modifier
                            </button>
                        </div>
                    ) : (
                        <div className="flex items-center gap-2">
                            <input
                                className="border rounded px-3 py-1 w-64"
                                value={nameInput}
                                onChange={(e) => setNameInput(e.target.value)}
                                onKeyDown={onNameKeyDown}
                                autoFocus
                            />
                            <button
                                className="px-3 py-1 rounded bg-blue-600 text-white"
                                onClick={saveName}
                            >
                                Enregistrer
                            </button>
                            <button
                                className="px-3 py-1 rounded border"
                                onClick={cancelEditName}
                            >
                                Annuler
                            </button>
                        </div>
                    )}
                </div>
            </div>

            {message && (
                <p className="text-sm text-green-700">{message}</p>
            )}
        </div>
    );
}
