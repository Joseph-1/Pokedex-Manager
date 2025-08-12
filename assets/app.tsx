import './bootstrap.js';
import { registerReactControllerComponents } from '@symfony/ux-react';
registerReactControllerComponents(require.context('./react/controllers', true, /\.(j|t)sx?$/));;
import './styles/app.scss';
import React from "react";
import PokemonList from './js/components/Pokemon/PokemonList';
import ReactDOM from "react-dom/client";

/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */


function App() {
    return (
        <div>
            <h1>Pokédex</h1>
            <PokemonList />
        </div>
    );
}

// Monter l'application sur la div #root de base.html.twig
const rootElement = document.getElementById('root');
if (rootElement) {
    ReactDOM.createRoot(rootElement).render(
        <React.StrictMode>
            <App />
        </React.StrictMode>
    );
}

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
