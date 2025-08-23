import React, { useState, useEffect } from "react";
import { fetchTalents } from '../../api/talentApi';
import type { Talent } from '../../../types/Talent';

export default function PokemonForm() {
    // Déclarer des State pour stocker les valeurs du formulaire
    const [name, setName] = useState("");
    const [pokedexId, setPokedexId] = useState("");
    const [size, setSize] = useState("");
    const [weight, setWeight] = useState("");
    const [sex, setSex] = useState("");
    const [type, setType] = useState("");
    const [imgSrc, setImgSrc] = useState("");
    const [message, setMessage] = useState("");
    const [talents, setTalents] = useState<Talent[]>([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);
    const [selectedTalent, setSelectedTalent] = useState<number | "">("");


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
                    type,
                    imgSrc,
                    talentId: selectedTalent,
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
                setType("");
                setImgSrc("");
                setSelectedTalent("");
            }
        } catch (error) {
            setMessage("Erreur réseau");
        }
    };

    return (
        <form onSubmit={handleSubmit} className="p-4 border rounded">
            <div className="mb-2">
                <label>Nom :</label>
                <input
                    type="text"
                    value={name}
                    onChange={(e) => setName(e.target.value)}
                    className="border p-2 ml-2"
                />
            </div>
            <div className="mb-2">
                <label>Pokédex Id :</label>
                <input
                    type="text"
                    value={pokedexId}
                    onChange={(e) => setPokedexId(e.target.value)}
                    className="border p-2 ml-2"
                />
            </div>
            <div className="mb-2">
                <label>Size :</label>
                <input
                    type="text"
                    value={size}
                    onChange={(e) => setSize(e.target.value)}
                    className="border p-2 ml-2"
                />
            </div>
            <div className="mb-2">
                <label>Weight :</label>
                <input
                    type="text"
                    value={weight}
                    onChange={(e) => setWeight(e.target.value)}
                    className="border p-2 ml-2"
                />
            </div>
            <div className="mb-2">
                <label>Sex :</label>
                <input
                    type="text"
                    value={sex}
                    onChange={(e) => setSex(e.target.value)}
                    className="border p-2 ml-2"
                />
            </div>
            <div className="mb-2">
                <label>Type :</label>
                <input
                    type="text"
                    value={type}
                    onChange={(e) => setType(e.target.value)}
                    className="border p-2 ml-2"
                />
            </div>
            <div className="mb-2">
                <label>Image :</label>
                <input
                    type="text"
                    value={imgSrc}
                    onChange={(e) => setImgSrc(e.target.value)}
                    className="border p-2 ml-2"
                />
            </div>
            <div className="mb-2">
                <label>Talent :</label>
                <select
                    value={selectedTalent}
                    onChange={(e) => setSelectedTalent(Number(e.target.value))}
                    className="border p-2 ml-2"
                >
                    <option value="">-- Choisir un talent --</option>
                    {talents.map((talent) => (
                        <option key={talent.id} value={talent.id}>
                            {talent.name}
                        </option>
                    ))}
                </select>
            </div>
            <button type="submit" className="bg-blue-500 text-white px-4 py-2 mt-2">
                Ajouter
            </button>
            {/* Message de succès ou erreur */}
            {message && <p className="mt-2">{message}</p>}
        </form>
    );
}
