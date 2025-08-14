import { Talent } from "./Talent";

export type Pokemon = {
    id: number;
    name: string;
    pokedexId: number;
    size?: number;
    weight?: number;
    sex?: string;
    type: string;
    imgSrc: string;
    talent: Talent;
};
