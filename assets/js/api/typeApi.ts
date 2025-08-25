export async function fetchTypes() {
    const response = await fetch('/api/types');

    if (!response.ok) {
        throw new Error('Failed to fetch types');
    }

    return response.json();
}
