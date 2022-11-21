/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme');
module.exports = {
  content: [],
  theme: {
    /** Variable screens */
    screens: {
      sm: '480px',
      md: '768px',
      lg: '976px',
      xl: '1440px',
    },
    colors: {
      'primary': '#36454F',
      'secondary': '#4B5F6D'
    },
    fontFamily: {
      'sans': ['Oswald', 'sans-serif'],
      'display': ['Oswald', 'sans-serif'],
      'body': ['Oswald', 'sans-serif']
    },
    extend: {},
  },
  plugins: [],
}
