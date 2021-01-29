module.exports = {
    purge: [],
    theme: {
        extend: {
            colors: {
                gray: {
                    '100': '#F7FAFC',
                    '200': '#EDF2F7',
                    '300': '#E2E8F0',
                    '400': '#CBD5E0',
                    '500': '#A0AEC0',
                    '600': '#718096',
                    '700': '#4A5568',
                    '800': '#2D3748',
                    '900': '#1A202C',
                    '1000': '#0d1119',
                },
            },
            spacing: {
                1.5: '0.313rem',
                1.6: '0.375em',
                2.5: '0.625rem',
                7: '1.875rem',
                13: '3.125rem',
                14: '3.370rem',
                15: '3.750rem',
            },
        },
    },
    variants: {
        borderWidth: ['responsive', 'last', 'hover', 'focus'],
    },
    plugins: [],
};