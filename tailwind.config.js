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
        'primary': '#181A20',
        'secondary': '#38BDF8',
      }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}

