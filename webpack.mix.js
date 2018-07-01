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

mix.webpackConfig({
    output: {
        chunkFilename: './publishable/assets/js/[name].js',
    },
});

mix.setPublicPath(__dirname)

    .options({
    processCssUrls: false
})
    .sass('./resources/assets/sass/app.scss', './publishable/assets/css/app.css')
    .js('./resources/assets/js/app.js', 'publishable/assets/js/app.js');

mix.styles([
    './resources/assets/sass/lte/adminlte.min.css',
    './resources/assets/sass/mdb/mdb.min.css',
    './resources/assets/plugins/iCheck/flat/blue.css',
    './resources/assets/plugins/morris/morris.css',
    './resources/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css',
    './resources/assets/plugins/datepicker/datepicker3.css',
    './resources/assets/plugins/daterangepicker/daterangepicker-bs3.css',
    './resources/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
    './publishable/assets/css/app.css'
], './publishable/assets/css/final.css');


mix.scripts([
    './resources/assets/',
    './resources/assets/',
], 'public/js/all.js');
