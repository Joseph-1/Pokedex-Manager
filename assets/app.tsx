import './bootstrap.js';
import { registerReactControllerComponents } from '@symfony/ux-react';
registerReactControllerComponents(require.context('./react/controllers', true, /\.(j|t)sx?$/));;
import './styles/app.scss';
import React from "react";
import ReactDOM from "react-dom/client";
import PokemonCard from "./components/PokemonCard";
import { Pokemon } from "./types/Pokemon";

/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */

const mockPokemons: Pokemon[] = [
    { id: 1, name: "Bulbizarre", pokedexId: 1, type: "Plante" },
    { id: 2, name: "Pikachu", pokedexId: 25, type: "Électrik" },
    { id: 3, name: "Salamèche", pokedexId: 4, type: "Feu" },
];

function App() {
    return (
        <div className="min-h-screen bg-gray-100 flex items-center justify-center gap-4 flex-wrap p-6">
            {mockPokemons.map((pokemon) => (
                <PokemonCard key={pokemon.id} pokemon={pokemon} />
            ))}
        </div>
    );
}

ReactDOM.createRoot(document.getElementById("root")!).render(<App />);

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
