import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/sidebar.css',
                'resources/css/home.css',
                'resources/css/student.css',
                'resources/js/app.js',
                'public/vendor/larasort/css/larasort.css',
            ],
            refresh: true,
        }),
    ],
});
