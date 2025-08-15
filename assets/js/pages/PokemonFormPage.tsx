import PokemonForm from "../components/Pokemon/PokemonForm";

export default function PokemonFormPage() {
    return (
        <div className="p-4">
            <h1 className="text-2xl font-bold mb-4">Ajouter un Pokémon</h1>
            <PokemonForm />
        </div>
    );
}
