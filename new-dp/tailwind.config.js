import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.jsx',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            maxWidth: {
                '8xl': '90rem', // 사용자 정의 최대 너비 추가
                '9xl': '100rem', // 더 큰 최대 너비 추가
            },
            gap:{
                '10': '10px',
                '30': '30px',
                '50': '50px',
            },
            colors:{
                'custom-bg':'#e5e7eb'
            }

        },
    },

    plugins: [forms],
};
