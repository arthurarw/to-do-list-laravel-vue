module.exports = {
    root: true,
    env: {
        node: true,
    },
    parserOptions: {
        parser: 'babel-eslint',
    },
    settings: {
        'import/resolver': {
            node: {
                extensions: ['.js', '.jsx', '.ts', '.tsx', '.json', '.vue'],
            },
            webpack: {
                config: require.resolve('@vue/cli-service/webpack.config.js'),
            },
        },
    },
    extends: [
        'eslint:recommended',
        'plugin:vue/strongly-recommended',
        'plugin:import/errors',
        'plugin:import/warnings',
    ],
    rules: {
        'no-console': process.env.NODE_ENV === 'production' ? 'error' : 'off',
        'no-debugger': process.env.NODE_ENV === 'production' ? 'error' : 'off',
        'indent': 'off',
        'comma-dangle': ['error', 'always-multiline'],
        'vue/valid-v-on': 'off',
        'semi': ['error', 'always'],
        'quotes': ['error', 'single'],
        'space-before-function-paren': ['error', 'never'],
        'no-unused-vars': ['error', { 'args': 'after-used' }],
        'vue/html-indent': ['error', 4],
        'vue/no-v-html': 'off',
        'vue/script-indent': ['error', 2, {
            baseIndent: 1,
            switchCase: 1,
        }],
        'vue/component-name-in-template-casing': ['error', 'PascalCase', {
            'ignores': ['/^c1-/'],
            'registeredComponentsOnly': false,
        }],
        'vue/match-component-file-name': ['error', {
            'extensions': ['vue'],
            'shouldMatchCase': false,
        }],
        'import/no-absolute-path': 'error',
        'import/newline-after-import': 'error',
        'import/no-unresolved': ['error'],
        'import/extensions': [
            'error',
            'ignorePackages',
            {
                js: 'never',
                mjs: 'never',
                jsx: 'never',
                ts: 'never',
                tsx: 'never',
                vue: 'never',
            },
        ],
    },
};