const mix = require('laravel-mix');
const path = require('path');

mix.webpackConfig({
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
        },
    },
});

mix.js('resources/js/searchPage.js', 'public/js')
    .minify('public/js/searchPage.js');
