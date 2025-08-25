import { Talent } from "./Talent";
import { Type } from "./Type";

export type Pokemon = {
    id: number;
    name: string;
    pokedexId: number;
    size?: number;
    weight?: number;
    sex?: string;
    type: string;
    imgSrc: string;

    // Relation ManyToOne
    talent: Talent;

    // Relation ManyToMany
    types: Type[];
};
