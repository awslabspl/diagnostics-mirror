/*
 * Copyright (c) 2021.
 */

import path from 'path';

export const ESM_WITH_JS_EXT = '/'; // relative to loader path
export const ESM_WITH_JS_EXT_URL = new URL(path.dirname("js") + `/${ESM_WITH_JS_EXT}`).href;

export function resolve(specifier, parentModuleURL, defaultResolver) {
    const resolvedModule = defaultResolver(specifier, parentModuleURL);

    if (resolvedModule.url === ESM_WITH_JS_EXT_URL)
        resolvedModule.format = 'esm';

    return resolvedModule;
}