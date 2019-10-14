const mix = require('laravel-mix');
const fs = require('fs');

class ResourceConfig {
    constructor(type, filesDir, outputDir, excludeFiles = []) {
        this.type = type;
        /*this.filesDir = filesDir;*/
        this.outputDir = outputDir;
        this.excludeFiles = excludeFiles || [];

        let files = fs.readdirSync(filesDir);
        this.excludeFiles.forEach(function (value) {
            if (files.includes(value)) {
                files.splice(files.indexOf(value), 1)
            }
        });

        files.forEach(function (value, index) {
            files[index] = filesDir + value;
        });

        this.files = files;
    }
}

const JS_CONFIG = new ResourceConfig('js', 'resources/js/', 'public/js/', ['required', 'components']);

const SASS_CONFIG = new ResourceConfig('sass', 'resources/sass/', 'public/css/', ['imported']);

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

/**
 *
 * @param {ResourceConfig} config
 */
function applyConf(config) {
    config.files.forEach(function (file) {
        mix[config.type](file, config.outputDir)
    });
}

applyConf(SASS_CONFIG);
applyConf(JS_CONFIG);

mix.disableSuccessNotifications();