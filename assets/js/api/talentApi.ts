export async function fetchTalents() {
    const response = await fetch('/api/talents');

    if (!response.ok) {
        throw new Error('Failed to fetch talents');
    }

    return response.json();
}
