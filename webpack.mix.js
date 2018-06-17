const {mix} = require('laravel-mix');

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

mix.setPublicPath('./')
    .options({
    processCssUrls: false
})
    .sass('./resources/assets/sass/app.scss', './publishable/assets/css/app.css')
    .js('./resources/assets/js/app.js', 'publishable/assets/js/app.js');
