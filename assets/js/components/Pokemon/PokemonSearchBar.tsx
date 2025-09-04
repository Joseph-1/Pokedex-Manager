import React from "react";
import { MagnifyingGlassIcon } from '@heroicons/react/24/solid';

type Props = {
    value: string;
    onChange: (value: string) => void;
};

export default function SearchBar({ value, onChange }: Props) {
    return (
        <div className="mb-4 relative w-full max-w-md mx-auto">
            <div className="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <MagnifyingGlassIcon className="h-5 w-5 text-gray-400" />
            </div>

            <input
                type="text"
                placeholder="Rechercher un Pokémon..."
                value={value}
                onChange={(e) => onChange(e.target.value)}
                className="border border-gray-300 rounded-full py-2 pl-10 pr-4 w-full focus:outline-none focus:ring-2
                focus:ring-indigo-400 hover:border-indigo-400"
            />
        </div>
    );
}

