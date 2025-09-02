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

    // State générique pour l'édition
    const [editingField, setEditingField] = useState<string | null>(null);
    const [editValue, setEditValue] = useState<string>('');
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
                setLoading(false);
            })
            .catch((err) => {
                setError(err.message || 'Erreur de chargement');
                setLoading(false);
            });
    }, [pokemonId]);

    // Fonctions génériques pour l'édition
    const startEdit = (field: string, currentValue: any) => {
        setEditingField(field);
        setEditValue(String(currentValue)); // initialise l'input avec la valeur actuelle
        setMessage(null);
    };

    const cancelEdit = () => {
        setEditingField(null);
        setEditValue('');
    };

    const saveEdit = async () => {
        if (!pokemon || !editingField) return;

        const trimmedValue = editValue.trim();
        if (trimmedValue === '') {
            setMessage('La valeur ne peut pas être vide');
            return;
        }

        try {
            const updated = await updatePokemon(pokemon.id, {
                [editingField]: trimmedValue, // PATCH dynamique en fonction du champ
            });

            // Mise à jour du state local avec la nouvelle valeur
            setPokemon((prev) =>
                prev ? { ...prev, [editingField]: updated[editingField] } : prev
            );

            setEditingField(null);
            setMessage(`${editingField} mis à jour avec succès !`);
        } catch (e: any) {
            setMessage(e.message || 'Erreur lors de la mise à jour');
        }
    };

    if (loading) return <p>Chargement...</p>;
    if (error) return <p className="text-red-500">{error}</p>;
    if (!pokemon) return <p>Pokémon introuvable</p>;

    return (
        <div className="space-y-4 max-w-md mx-auto">
            {/* --- Édition du nom --- */}
            <div>
                <label className="font-semibold">Nom :</label>
                {editingField === 'name' ? (
                    <div className="flex gap-2 mt-1">
                        <input
                            type="text"
                            value={editValue}
                            onChange={(e) => setEditValue(e.target.value)}
                            className="border px-2 py-1 flex-1"
                        />
                        <button
                            onClick={saveEdit}
                            className="bg-green-500 text-white px-3 py-1 rounded"
                        >
                            Enregistrer
                        </button>
                        <button
                            onClick={cancelEdit}
                            className="bg-gray-300 px-3 py-1 rounded"
                        >
                            Annuler
                        </button>
                    </div>
                ) : (
                    <p
                        className="cursor-pointer mt-1"
                        onClick={() => startEdit('name', pokemon.name)}
                    >
                        {pokemon.name}
                    </p>
                )}
            </div>

            {/* --- Édition du Pokédex ID --- */}
            <div>
                <label className="font-semibold">Pokédex ID :</label>
                {editingField === 'pokedexId' ? (
                    <div className="flex gap-2 mt-1">
                        <input
                            type="number"
                            value={editValue}
                            onChange={(e) => setEditValue(e.target.value)}
                            className="border px-2 py-1 flex-1"
                        />
                        <button
                            onClick={saveEdit}
                            className="bg-green-500 text-white px-3 py-1 rounded"
                        >
                            Enregistrer
                        </button>
                        <button
                            onClick={cancelEdit}
                            className="bg-gray-300 px-3 py-1 rounded"
                        >
                            Annuler
                        </button>
                    </div>
                ) : (
                    <p
                        className="cursor-pointer mt-1"
                        onClick={() => startEdit('pokedexId', pokemon.pokedexId)}
                    >
                        {pokemon.pokedexId}
                    </p>
                )}
            </div>

            {/* --- Message de succès ou d'erreur --- */}
            {message && <p className="text-blue-500">{message}</p>}
        </div>
    );
}
