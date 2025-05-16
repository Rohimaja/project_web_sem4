import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                // "resource/js/pages/master-admin.js",
                // "resource/js/components/image-preview.js",
                // "resource/js/components/form-validasi.js",
            ],
            refresh: true,
        }),
    ],
});
