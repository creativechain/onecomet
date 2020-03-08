/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./required/bootstrap');

let {Application} = require('./required/application');

let cookies = require('js-cookie');


window.App = new Application();
window.Cookies = cookies;

(function() {
    App.fetchPrice('cgy', 'eur');

    $(document).ready(function () {

        let setLang = function (lang) {
            Cookies.set('lang', lang);
            location.reload();
        };

        $('#lang-en').click(function () {
            setLang('en');
        });

        $('#lang-es').click(function () {
            setLang('es');
        });

        let lang = Cookies.get('lang');
        if (!lang) {
            setLang(navigator.language.split('-')[0])
        }

    })

})();
