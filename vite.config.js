import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/sass/app.scss', 'resources/js/app.js'],
            refresh: true,
            // force manifest generation
            buildDirectory: 'build',
        }),
    ],
    build: {
        outDir: 'public/build',
        emptyOutDir: true,
    },
    base: process.env.ASSET_URL ? process.env.ASSET_URL + '/' : '/',
});
