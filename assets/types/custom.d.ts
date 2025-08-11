declare interface Require {
    context(
        path: string,
        deep?: boolean,
        filter?: RegExp
    ): {
        keys(): string[];
        <T>(id: string): T;
    };
}

// @ts-ignore
declare const require: Require;
