const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js').version()
    .js('resources/js/custom.js', 'public/js/custom.js')
    .js('resources/js/bootstrap.js', 'public/js/bootstrap.js')
    .js('resources/js/chart.js', 'public/js/chart.js')
    .js('resources/js/deshboard.js', 'public/js/deshboard.js')
    .js('resources/js/feather.js', 'public/js/feather.js')
    .sass('resources/sass/app.scss', 'public/css/all.css')
    .styles('resources/css/app.css', 'public/css/custom.css')

.sourceMaps().version();