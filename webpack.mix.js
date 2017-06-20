const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
    .copy('node_modules/inline-attachment/src/inline-attachment.js', 'public/js/inline-attachment.js')
    .copy('node_modules/inline-attachment/src/jquery.inline-attachment.js', 'public/js/jquery.inline-attachment.js');


if (mix.config.inProduction) {
    mix.version();
}

mix.browserSync("blog.app");