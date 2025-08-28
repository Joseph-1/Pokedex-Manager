import './bootstrap.js';
import { registerReactControllerComponents } from '@symfony/ux-react';
registerReactControllerComponents(require.context('./react/controllers', true, /\.(j|t)sx?$/));

import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import './styles/app.scss';
import React from "react";
import PokemonList from './js/components/Pokemon/PokemonList';
import Navbar from "./js/components/Navbar";
import PokemonFormPage from "./js/pages/PokemonFormPage";
import PokemonAllDetails from "./js/components/Pokemon/PokemonAllDetails";
import ReactDOM from "react-dom/client";

/*
 * Welcome to your app's main JavaScript file!
 * Ce fichier est monté via importmap() dans base.html.twig
 */

function App() {
    return (
        <Router>
            {/* Navbar affichée sur toutes les pages */}
            <Navbar />

            {/* Définition des routes */}
            <Routes>
                {/* Page d'accueil */}
                <Route path="/" element={<PokemonList />} />

                {/* Page d'ajout d'un Pokémon */}
                <Route path="/ajouter" element={<PokemonFormPage />} />

                {/* Page du détail complet d'un Pokémon */}
                <Route path="/pokemon/:id" element={<PokemonAllDetails />} />
            </Routes>
        </Router>
    );
}

// Monter l'application sur la div #root
const rootElement = document.getElementById('root');
if (rootElement) {
    ReactDOM.createRoot(rootElement).render(
        <React.StrictMode>
            <App />
        </React.StrictMode>
    );
}

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');
