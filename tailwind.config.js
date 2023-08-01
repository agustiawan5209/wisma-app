import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Open Sans', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                'primary': '#DF2E38',
                'base': '#3C486B',
                'second': '#F9D949',
                'light':'#F0F0F0'
            },
            height:{
                '10-vh': '10vh',
                '1/5-vh': '15vh',
                '20-vh': '20vh',
                '30-vh': '30vh',
                '40-vh': '40vh',
                '50-vh': '50vh',
                '60-vh': '60vh',
                '70-vh': '70vh',
                '80-vh': '80vh',
                '90-vh': '90vh',
            }
        },

    },

    plugins: [forms],
};
