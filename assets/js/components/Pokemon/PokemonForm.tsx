import React, { useState, useEffect } from "react";
import { fetchTalents } from '../../api/talentApi';
import type { Talent } from '../../../types/Talent';
import { fetchTypes } from '../../api/typeApi';
import type { Type } from '../../../types/Type';

export default function PokemonForm() {
    // Déclarer des State pour stocker les valeurs du formulaire
    const [name, setName] = useState("");
    const [pokedexId, setPokedexId] = useState("");
    const [size, setSize] = useState("");
    const [weight, setWeight] = useState("");
    const [sex, setSex] = useState("");
    const [imgSrc, setImgSrc] = useState("");
    const [description, setDescription] = useState("");

    const [message, setMessage] = useState("");
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);

    // Talents
    const [talents, setTalents] = useState<Talent[]>([]);
    const [selectedTalent, setSelectedTalent] = useState<number | "">("");

    // Types
    const [types, setTypes] = useState<Type[]>([]);
    const [selectedTypes, setSelectedTypes] = useState<number[]>([]);

    useEffect(() => {
        // permet de lancer deux appels en parallèle et attendre que les soient terminés avant de continuer
        Promise.all([fetchTalents(), fetchTypes()])
            .then(([talentsData, typesData]) => {
                setTalents(talentsData);
                setTypes(typesData);
                setLoading(false);
            })
            .catch(err => {
                setError(err.message);
                setLoading(false);
            });
    }, []);

/* Avant
    useEffect(() => {
        fetchTalents()
            .then(data => {
                setTalents(data);
                setLoading(false);
           })
            .catch(err => {
                setError(err.message);
                setLoading(false);
            });
    }, []);
 */

    // Toggle pour les checkboxes
    const handleTypeChange = (id: number) => {
        if (selectedTypes.includes(id)) {
            setSelectedTypes(selectedTypes.filter(t => t !== id));
        } else {
            setSelectedTypes([...selectedTypes, id]);
        }
    };

    if (loading) return <p>Chargement...</p>
    if (error) return <p>Erreur:  {error}</p>

    // Fonction qui s'exécute quand on envoie le formulaire
    // "e: React.FormEvent" permet de créer un événement et rendre "e.preventDefault()" utilisable
    const handleSubmit = async (e: React.FormEvent) => {
        // Empêche le rechargement de la page
        e.preventDefault();

        try {
            const response = await fetch("/api/pokemon/create", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    name,
                    pokedexId,
                    // Bien respecter le typage que j'ai précisé dans l'Entity
                    size: parseFloat(size),
                    weight: parseFloat(weight),
                    sex,
                    imgSrc,
                    description,
                    talentId: selectedTalent,
                    // Envoie d'un tableau d'Id
                    typeIds: selectedTypes,
                }),
            });

            const data = await response.json();

            if (!response.ok) {
                setMessage(`Erreur : ${data.error}`);
            } else {
                setMessage("Pokémon ajouté avec succès !")
                setName("");
                setPokedexId("");
                setSize("");
                setWeight("");
                setSex("");
                setImgSrc("");
                setDescription("");
                setSelectedTalent("");
                setSelectedTypes([]);
            }
        } catch (error) {
            setMessage("Erreur réseau");
        }
    };

    return (
        <form
            onSubmit={handleSubmit}
            className="p-6 bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg max-w-lg mx-auto space-y-4"
        >

            <div className="max-w-lg mx-auto p-4">
                <h1 className="text-3xl font-bold text-gray-900 mb-2">Ajouter un nouveau Pokémon</h1>
                <p className="text-gray-600">
                    Remplissez les informations ci-dessous pour créer un Pokémon dans votre Pokédex.
                </p>
            </div>

            {/* Nom */}
            <div>
                <label className="block font-semibold text-gray-700 mb-1">Nom :</label>
                <input
                    type="text"
                    value={name}
                    onChange={(e) => setName(e.target.value)}
                    className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300"
                />
            </div>

            {/* Pokédex Id */}
            <div>
                <label className="block font-semibold text-gray-700 mb-1">Pokédex Id :</label>
                <input
                    type="text"
                    value={pokedexId}
                    onChange={(e) => setPokedexId(e.target.value)}
                    className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300"
                />
            </div>

            {/* Size */}
            <div>
                <label className="block font-semibold text-gray-700 mb-1">Taille (m) :</label>
                <input
                    type="text"
                    value={size}
                    onChange={(e) => setSize(e.target.value)}
                    className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300"
                />
            </div>

            {/* Weight */}
            <div>
                <label className="block font-semibold text-gray-700 mb-1">Poids (kg) :</label>
                <input
                    type="text"
                    value={weight}
                    onChange={(e) => setWeight(e.target.value)}
                    className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300"
                />
            </div>

            {/* Sex */}
            <div>
                <label className="block font-semibold text-gray-700 mb-1">Sexe :</label>
                <input
                    type="text"
                    value={sex}
                    onChange={(e) => setSex(e.target.value)}
                    className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300"
                />
            </div>

            {/* Image */}
            <div>
                <label className="block font-semibold text-gray-700 mb-1">Image URL :</label>
                <input
                    type="text"
                    value={imgSrc}
                    onChange={(e) => setImgSrc(e.target.value)}
                    className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300"
                />
            </div>

            {/* Description */}
            <div>
                <label className="block font-semibold text-gray-700 mb-1">Description :</label>
                <input
                    type="text"
                    value={description}
                    onChange={(e) => setDescription(e.target.value)}
                    className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300"
                />
            </div>

            {/* Talent */}
            <div>
                <label className="block font-semibold text-gray-700 mb-1">Talent :</label>
                <select
                    value={selectedTalent}
                    onChange={(e) => setSelectedTalent(Number(e.target.value))}
                    className="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-300"
                >
                    <option value="">-- Choisir un talent --</option>
                    {talents.map((talent) => (
                        <option key={talent.id} value={talent.id}>
                            {talent.name}
                        </option>
                    ))}
                </select>
            </div>

            {/* Types */}
            <div>
                <label className="block font-semibold text-gray-700 mb-1">Types :</label>
                <div className="flex flex-wrap gap-2">
                    {types.map((type) => (
                        <label
                            key={type.id}
                            className="flex items-center bg-white/50 px-3 py-1 rounded-full cursor-pointer hover:bg-indigo-100 transition"
                        >
                            <input
                                type="checkbox"
                                checked={selectedTypes.includes(type.id)}
                                onChange={() => handleTypeChange(type.id)}
                                className="mr-2"
                            />
                            {type.name}
                        </label>
                    ))}
                </div>
            </div>

            {/* Bouton */}
            <button
                type="submit"
                className="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-semibold py-2 rounded-lg transition"
            >
                Ajouter
            </button>

            {/* Message */}
            {message && (
                <p className="text-center text-sm text-gray-700 mt-2">{message}</p>
            )}
        </form>
    );
}
