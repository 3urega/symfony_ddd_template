const Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    .autoProvideVariables({
        // Update those to your needs
        $: 'jquery',
        jQuery: 'jquery',
        moment: 'moment'
    })

    .addEntry('app', './assets/js/app.js')
    .addStyleEntry('styles/app', './assets/styles/app.scss')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()
    .enableSingleRuntimeChunk()

    /* FEATURE CONFIG */

    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // .configureBabel((config) => {  config.plugins.push('@babel/plugin-proposal-class-properties'); })

    // enables @babel/preset-env polyfills
    // .configureBabelPresetEnv((config) => { config.useBuiltIns = 'usage'; config.corejs = 3; })

    // enables Sass/SCSS support
    .enableSassLoader()

    //Usuario
    // .addEntry('js/usuario/listado/index', './assets/js/usuario/listado/index.js')
    .addEntry('js/producto-backoffice/formulario/index', './apps/backoffice/frontend/assets/js/producto-backoffice/formulario/index.js')
    
    //Envios
    .addEntry('js/producto-backoffice/listado/index', './apps/backoffice/frontend/assets/js/producto-backoffice/listado/index.js')
    // .addEntry('js/envio/admin/formulario/index', './assets/js/envio/admin/formulario/index.js')
    // .addEntry('js/envio/proquimia/listado/index', './assets/js/envio/proquimia/listado/index.js')
    // .addEntry('js/envio/transportista/formulario/index', './assets/js/envio/transportista/formulario/index.js')
    
    //Plugins
    .addStyleEntry('styles/vendor/dataTablesBs4', './node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css')
    .addStyleEntry('styles/vendor/daterangepicker', './node_modules/daterangepicker/daterangepicker.css')
    .addStyleEntry('styles/vendor/select2', './node_modules/select2/dist/css/select2.css')

    //Test
    // .addEntry('js/test/file-test', './assets/js/test/file-test.js')

    .copyFiles({
        from: './assets/images',
        to: 'images/[path][name].[ext]'
    })

    .copyFiles({
        from: './apps/shared/assets/js/vendor',
        to: 'js/vendor/[path][name].[ext]'
    })

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment if you use React
    //.enableReactPreset()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    //.enableIntegrityHashes(Encore.isProduction())

    // uncomment if you're having problems with a jQuery plugin
    //.autoProvidejQuery()
;

module.exports = Encore.getWebpackConfig();
