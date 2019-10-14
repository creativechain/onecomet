const mix = require('laravel-mix');
const fs = require('fs');

const JS_FILES_DIR = 'resources/js/';
const JS_OUTPUT_DIR = 'public/js/';
const JS_EXCLUDE_FILES = [
    'required', 'components'
];

const SASS_FILES_DIR = 'resources/sass/';
const SASS_OUTPUT_DIR = 'public/css/';
const SASS_EXCLUDE_FILES = [
    'imported'
];

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

const JS_FILES = fs.readdirSync(JS_FILES_DIR);

JS_EXCLUDE_FILES.forEach(function (value) {
    JS_FILES.splice(JS_FILES.indexOf(value), 1);
});

const SASS_FILES = fs.readdirSync(SASS_FILES_DIR);

SASS_EXCLUDE_FILES.forEach(function (value) {
    SASS_FILES.splice(SASS_FILES.indexOf(value), 1);
});

JS_FILES.forEach(function (value, index, array) {
    mix.js(JS_FILES_DIR + value, JS_OUTPUT_DIR);
});

SASS_FILES.forEach(function (value, index, array) {
    mix.sass(SASS_FILES_DIR + value, SASS_OUTPUT_DIR);
});

mix.disableSuccessNotifications();