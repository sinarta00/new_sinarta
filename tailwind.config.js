/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./app/Filament/**/*.php",
  ],
  theme: {
    extend: {
      colors: {
        maroon: {
          DEFAULT: '#800020',
          dark: '#5c0017',
          light: '#a6002b',
        },
        yellow: {
          DEFAULT: '#FFD700',
          light: '#FFED4E',
        }
      },
    },
  },
  plugins: [],
}