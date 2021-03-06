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

    .copyFiles({
        from: './assets/img',
    //optional target path, relative to the output dir
        to: '../img/[path][name].jpg',
    /*
    // if versioning is enabled, add the file hash too //to: 'images/[path][name].[hash:8].[ext]',
    // only copy files matching this pattern //pattern: /\.(png|jpg|jpeg)$/
    */
    })

    /*
     * ENTRY CONFIG
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if your JavaScript imports CSS.
     */
    .addEntry('app', './assets/app.js')
    .addEntry('user', './assets/user.js')
    .addEntry('game', './assets/game.js')
    .addEntry('order', './assets/order.js')
    .addEntry('accueil', './assets/accueil.js')
    .addEntry('profile', './assets/profile.js')
    .addEntry('register', './assets/register.js')
    .addEntry('menu', './assets/menu.js')
    .addEntry('concept', './assets/concept.js')
    .addEntry('legals', './assets/legals.js')
    .addEntry('panier', './assets/panier.js')
    .addEntry('game_show', './assets/game_show.js')
    .addEntry('calendar_back', './assets/calendar_back.js')
    .addEntry('game_back', './assets/game_back.js')
    .addEntry('error', './assets/error.js')
    .addEntry('login', './assets/login.js')
    .addEntry('add_session', './assets/add_session.js')
    .addEntry('calendar_edit', './assets/calendar_edit.js')
    .addEntry('add_order', './assets/add_order.js')
    .addEntry('calendar_show', './assets/calendar_show.js')
    .addEntry('game_add', './assets/game_add.js')



    
    // enables the Symfony UX Stimulus bridge (used in assets/bootstrap.js)
    .enableStimulusBridge('./assets/controllers.json')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    .configureBabel((config) => {
        config.plugins.push('@babel/plugin-proposal-class-properties');
    })

    // enables @babel/preset-env polyfills
    .configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })

    //enables Sass/SCSS support
    //.enableSassLoader()

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


