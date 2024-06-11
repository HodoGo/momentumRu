/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./resources/**/*.blade.php", "./resources/**/*.js"],
  theme: {
    extend: {
      colors: {
        "momentum1": "#F9AE48",
        "momentum2": "#244771"
      }
    },
  },
  plugins: [],
}

