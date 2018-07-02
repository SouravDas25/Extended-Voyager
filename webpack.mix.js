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
    .js('./resources/assets/js/app.js', 'publishable/assets/js/app.js')

.styles([
    './resources/assets/sass/lte/adminlte.min.css',
    './resources/assets/sass/mdb/mdb.min.css',
    './resources/assets/plugins/iCheck/flat/blue.css',
    './resources/assets/plugins/morris/morris.css',
    './resources/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css',
    './resources/assets/plugins/datepicker/datepicker3.css',
    './resources/assets/plugins/daterangepicker/daterangepicker-bs3.css',
    './resources/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
    './resources/assets/js/lte/plugins/datatable/jquery.dataTables.min.css',
    './resources/assets/plugins/select2/select2.css',
    './publishable/assets/css/app.css'
], './publishable/assets/css/final.css')


.scripts([
    './resources/assets/plugins/jquery/jquery.min.js',
    './resources/assets/js/lte/plugins/jquery/jquery-ui.min.js',
    './resources/assets/plugins/bootstrap/js/bootstrap.bundle.min.js',
    './resources/assets/js/mdb/mdb.min.js',
    './resources/assets/js/lte/plugins/vue/vue.js',
    './resources/assets/js/lte/plugins/dropzone/dropzone.js',
    './resources/assets/plugins/select2/select2.full.min.js',
    './resources/assets/js/lte/plugins/raphael/raphael-min.js',
    './resources/assets/plugins/morris/morris.min.js',
    './resources/assets/plugins/sparkline/jquery.sparkline.min.js',
    './resources/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js',
    './resources/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js',
    './resources/assets/plugins/knob/jquery.knob.js',
    './resources/assets/js/lte/plugins/raphael/moment/moment.min.js',
    './resources/assets/plugins/daterangepicker/daterangepicker.js',
    './resources/assets/plugins/datepicker/bootstrap-datepicker.js',
    './resources/assets/plugins/colorpicker/bootstrap-colorpicker.min.js',
    './resources/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js',
    './resources/assets/plugins/slimScroll/jquery.slimscroll.min.js',
    './resources/assets/plugins/fastclick/fastclick.js',
    './resources/assets/js/lte/plugins/jquery/jquery.nestable.js',
    './resources/assets/js/lte/plugins/jquery/jquery.matchHeight.js',
    './resources/assets/js/lte/plugins/ace/ace.js',

    './resources/assets/js/lte/adminlte.js',
    './resources/assets/js/lte/plugins/datatable/jquery.dataTables.min.js',
    './resources/assets/js/bootstrap-datatables.js',
    './resources/assets/js/media.js',
    './resources/assets/js/voyager_ace_editor.js',
    //'./resources/assets/js/lte/pages/dashboard.js',
    //'./resources/assets/js/lte/demo.js',
    './resources/assets/js/mdb/sd_voyager.js',
], './publishable/assets/js/final.js');
