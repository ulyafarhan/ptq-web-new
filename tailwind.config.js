import defaultTheme from 'tailwindcss/defaultTheme';

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
                    500: '#10b981', // Emerald-500
                    600: '#059669', // Emerald-600
                    900: '#064e3b', // Emerald-900
                }
            }
        },
    },

    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
    ],
};