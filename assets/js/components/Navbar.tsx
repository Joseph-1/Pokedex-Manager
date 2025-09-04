import { Link } from "react-router-dom";

// Composant simple qui contient des liens vers nos pages
export default function Navbar() {
    return (
        <nav className="bg-white shadow-md p-4 mb-6 flex justify-between items-center sticky top-0 z-50">
            <div className="flex items-center space-x-6">
                <Link
                    to="/"
                    className="text-gray-800 font-semibold hover:text-indigo-500 hover:translate-y-[-1px]
                    transition-colors duration-200"
                >
                    Accueil
                </Link>
                <Link
                    to="/ajouter"
                    className="text-gray-800 font-semibold hover:text-indigo-500 hover:translate-y-[-1px]
                    transition-colors duration-200"
                >
                    Ajouter un Pokémon
                </Link>
            </div>
        </nav>
    );
}
