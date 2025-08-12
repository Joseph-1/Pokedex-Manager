export async function fetchPokemons() {
    // On fait une requête GET vers l’URL relative de l’API
    const response = await fetch('/api/pokemons');

    // Vérification que la réponse est OK (status HTTP 200-299)
    if (!response.ok) {
        // On lève une erreur pour pouvoir la gérer côté React
        throw new Error('Failed to fetch pokemons');
    }

    // On parse la réponse JSON en objet JavaScript (tableau de pokémons)
    return response.json();
}
