import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
// 1. Import helper plugin di sini
const plugin = require('tailwindcss/plugin');

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
                sans: ['"Inter"', ...defaultTheme.fontFamily.sans],
                heading: ['"Outfit"', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                white: '#F5F5F5',
                black: '#0F172A',
                brand: {
                    50: '#ecfdf5',
                    100: '#d1fae5',
                    500: '#10b981',
                    600: '#059669',
                    900: '#064e3b',
                }
            }
        },
    },

    plugins: [
        typography,
        forms,
        
        plugin(function({ addUtilities }) {
            addUtilities({
                '.no-scrollbar': {
                    /* Firefox */
                    'scrollbar-width': 'none',
                    /* IE and Edge */
                    '-ms-overflow-style': 'none',
                    /* Chrome, Safari and Opera */
                    '&::-webkit-scrollbar': {
                        display: 'none',
                    },
                },
            });
        }),
    ],
};