import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/scss/home.scss',
                'resources/scss/options.scss',
                'resources/js/app.js',
                'resources/js/options.js',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ]
});
