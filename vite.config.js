import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    build: {
        minify: 'esbuild', // or 'terser'
    },
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/main.js',
            ],
            refresh: true,
        }),
        vue(),
    ],
});
