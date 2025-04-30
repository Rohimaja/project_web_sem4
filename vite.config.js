<<<<<<< HEAD
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
=======
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
>>>>>>> c0e2562 (first commit)

export default defineConfig({
    plugins: [
        laravel({
<<<<<<< HEAD
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
=======
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resource/js/pages/master-admin",
                "resource/js/components/image-preview",
            ],
            refresh: true,
        }),
>>>>>>> c0e2562 (first commit)
    ],
});
