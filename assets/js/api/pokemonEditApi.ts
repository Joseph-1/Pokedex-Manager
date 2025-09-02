export type PokemonUpdatePayload = {
    name?: string;
};

export async function updatePokemon(id: number, payload: PokemonUpdatePayload) {
    const res = await fetch(`/api/pokemons/${id}`, {
        method: 'PATCH',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload),
    });

    const data = await res.json();
    if (!res.ok) {
        throw new Error(data?.error || 'Erreur lors de la mise à jour');
    }
    return data;
}
