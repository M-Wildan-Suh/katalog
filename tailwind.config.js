import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                montserrat: ['Montserrat', 'sans-serif'],
            },
            colors: {
                'byolink-1' : '#1F4068',
                'byolink-2' : '#DE0301',
                'byolink-3' : '#8E1616',
            }
        },
    },

    plugins: [forms],
};
