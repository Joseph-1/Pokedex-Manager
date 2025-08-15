import { Link } from "react-router-dom";

// Composant simple qui contient des liens vers nos pages
export default function Navbar() {
    return (
        <nav className="p-4 mb-6 bg-gray-200">
            {/* "Link" fonctionne comme <a>, mais sans recharger la page */}
            <Link to="/" className="mr-4">Liste des Pokémons</Link>
            <Link to="/ajouter">Ajouter un Pokémon</Link>
        </nav>
    );
}
