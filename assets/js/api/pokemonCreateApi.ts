export async function fetchPokemons() {
    const response = await fetch('/api/pokemon/create');

    if (!response.ok) {
        throw new Error('Failed to fetch pokemons');
    }

    return response.json();
}
