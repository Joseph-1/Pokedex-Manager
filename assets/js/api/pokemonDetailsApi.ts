export async function fetchPokemonDetails(id: number){
    // On ne peut pas directement mettre {id} dans l'url sinon erreur 404 → plutôt ${id} et le mettre en paramètre et
    // utiliser des backticks et pas des quotes classique /!\
    const response = await fetch(`/api/pokemons/${id}`);

    if(!response.ok) {
        throw new Error('Failed to fetch pokemons details');
    }

    return response.json();
}
