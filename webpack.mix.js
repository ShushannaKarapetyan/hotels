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

mix.sourceMaps(false, 'source-map').version()
    .copy('resources/assets/img/', 'public/img', false)

    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/paper-dashboard/pages/_room-fields.scss', 'public/css')
    .sass('resources/assets/sass/paper-dashboard/pages/free-rooms.scss', 'public/css')

    .js('resources/assets/js/app.js', 'public/js')
    .js('resources/assets/js/modules/hotel-types.js', 'public/js/modules')
    .js('resources/assets/js/modules/hotel-rooms.js', 'public/js/modules')
    .js('resources/assets/js/modules/free-rooms.js', 'public/js/modules');
