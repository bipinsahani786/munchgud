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
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                mg: {
                    green: '#1B4332',
                    orange: '#E85D04',
                    yellow: '#FFB703',
                    cream: '#FAF7F0',
                    dark: '#081c15',
                    muted: '#6B7280'
                }
            }
        },
    },

    plugins: [forms],
};
