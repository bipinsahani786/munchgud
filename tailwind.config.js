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
                sans: ['Outfit', 'Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
                heading: ['"Playfair Display"', 'serif'],
                body: ['"DM Sans"', 'sans-serif'],
                serif: ['"Playfair Display"', 'serif'],
            },
            colors: {
                'mg-green': '#2B6E2F',
                'mg-green-dark': '#1B4332',
                'mg-green-light': '#4CAF50',
                'mg-leaf': '#66BB6A',
                'mg-cream': '#FAFAF5',
                'mg-warm': '#F5F5EC',
                'mg-orange': '#E07B2A',
                'mg-gold': '#D4A847',
                'mg-dark': '#1A1A1A',
                'mg-muted': '#6B7280',
                munch: {
                    50: '#F5F8F6',
                    100: '#E6EFE8',
                    200: '#CDE0D2',
                    300: '#A3C6AB',
                    400: '#75A581',
                    500: '#52865F',
                    600: '#3D6A48',
                    700: '#32543B',
                    800: '#2A4331',
                    900: '#1B4332',
                    950: '#11251A',
                    accent: '#D47F35',
                    cream: '#FAFAF5',
                }
            },
            boxShadow: {
                'nav': '0 2px 40px 0 rgba(27,67,50,0.08)',
                'card': '0 4px 32px 0 rgba(27,67,50,0.07)',
                'dropdown': '0 8px 40px 0 rgba(27,67,50,0.13)',
            }
        },
    },

    plugins: [forms],
};
