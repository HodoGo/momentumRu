/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php", 
        "./resources/**/*.js",
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                momentum1: "#F9AE48",
                momentum2: "#244771",
            },
            backgroundImage: {
                "quiz-1": "url('/images/quizzes/quiz-1.webp')",
            },
        },
    },
    plugins: [],
};
