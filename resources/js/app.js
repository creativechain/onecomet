/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./required/bootstrap');

const Application = require('./required/application');

module.exports = function () {
    console.log('Welcome');
    const oc = new Application();

    setInterval(function () {

        oc.fetchPrice('crea', 'eur');

    }, 5 * 1000);
}