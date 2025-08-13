import React from "react";

type Props = {
    value: string;
    onChange: (value: string) => void;
};

export default function SearchBar({ value, onChange }: Props) {
    return (
        <div className="mb-4 relative w-full max-w-md mx-auto">
            <input
                type="text"
                placeholder="Rechercher un Pokémon..."
                value={value}
                onChange={(e) => onChange(e.target.value)}
                className="border border-gray-300 rounded-full py-2 pl-4 pr-4 w-full focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            />
        </div>
    );
}
