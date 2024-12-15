/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary: "rgb(var(--color-primary) / <alpha-value>)",
                "primary-dark":
                    "rgb(var(--color-primary-dark) / <alpha-value>)",
                secondary: "rgb(var(--color-secondary) / <alpha-value>)",
            },
        },
    },
    plugins: [],
};
