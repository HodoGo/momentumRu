/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./resources/**/*.blade.php", "./resources/**/*.js"],
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
