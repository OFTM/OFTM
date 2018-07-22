let mix = require('laravel-mix');

const GoogleFontsPlugin = require("google-fonts-webpack-plugin")
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
    .webpackConfig({
        devtool: 'source-map',
        plugins: [
            new GoogleFontsPlugin({
                fonts: [
                    { family: "Raleway", variants: ["300", "400", "600"]}
                ],
                path: "fonts/",
                filename: "css/fonts.css"
            })
        ]
    })
    .copy('node_modules/font-awesome/fonts', 'public/fonts')
    .sourceMaps();

