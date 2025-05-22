import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: "class",
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                customblue: "#1E88E4",
                darkBg: "#1E293B", // kamu bisa ganti sesuai kebutuhan
                darkCard: "#334155",
                darkBorder: "#475569",
            },
        },
    },
    darkMode: "class", // Atur dark mode menggunakan kelas 'dark'

    plugins: [forms],
};
