// tailwind.config.js
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            keyframes: {
                "fade-down": {
                    "0%": { opacity: "0", transform: "translateY(-20px)" },
                    "100%": { opacity: "1", transform: "translateY(0)" },
                },
                "fade-up": {
                    "0%": { opacity: "0", transform: "translateY(20px)" },
                    "100%": { opacity: "1", transform: "translateY(0)" },
                },
            },
            animation: {
                "fade-down": "fade-down 0.5s ease-out",
                "fade-up": "fade-up 0.5s ease-out",
            },
        },
    },
    plugins: [],
};
