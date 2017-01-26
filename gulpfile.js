var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.styles([
        'pace-theme-flash.css',
        'bootstrap.min.css',
        'font-awesome.css',
        'jquery.scrollbar.css',
        'select2.min.css',
        'switchery.min.css',
        'pages-icons.css',
        'pages.css',
    ]);

    mix.scripts([
        'jquery-1.11.1.min.js',
        'jquery-ui.min.js',
        'bootstrap.min.js',
        'pages.min.js',
        'angular.min.js',
    ]);

    mix.browserSync();
});
