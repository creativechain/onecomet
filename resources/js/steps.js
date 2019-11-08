
const Vue = require('vue');

Vue.component('google-pay', require('./components/GooglePayButton.vue').default);

const buyProcess = new Vue({
    el: '#buy-process',
    data: {
        step: 1,
        form: {
            amount: parseInt(window.settings.min_payment / Math.pow(10, window.fiat.precision)),
            token: 'crea',
            username: '',
            payment_method: 'card',
            email: '',
            phone: '',
            name: '',
            surname: '',
            birth_date: '',
            address: '',
            zip_code: '',
            state: '',
            country: '',
        },
        lastPrice: window.lastPrice,
        settings: window.settings,
        fiat: window.fiat
    },
    computed: {
        formattedAmount: function() {
            return ("" + this.form.amount).replace('.', ',');
        },
        comissionAmount: function () {
            if (this.settings.feeType === 'variable') {
                let feeValue = this.settings['fee'] / 100;
                return this.form.amount - (this.form.amount * feeValue);
            }

            return this.form.amount - this.settings['fee'];
        },
        ocComission: function () {
            if (this.settings.feeType === 'variable') {
                let feeValue = this.settings['fee'] / 100;
                return this.form.amount * feeValue;
            }

            return parseFloat(this.settings['fee']);
        },
        comission: function () {
            if (this.settings.feeType === 'variable') {
                return this.settings['fee']  + '%';
            }

            return this.settings['fee'] + ' ' . this.fiat.symbol;
        },
        stripeComission: function () {
            let fixed = 0.25;

            return ((this.form.amount * 0.029) + fixed);
        },
        total: function () {
            return parseFloat(this.form.amount) + this.stripeComission;
        }
    },
    methods: {
        nextStep: function (currentStep) {
            switch (currentStep) {
                case 1:
                    this.step = 2;
                    break;
            }

            this.step = ++currentStep;
        },
        backStep: function (currentStep) {

            this.step = --currentStep;
        },

    }
});


setTimeout(function () {

    App.on('price.update', function (currency, counterCurrency, price) {
        buyProcess.lastPrice = price;
    });
});

