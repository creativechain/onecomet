
const Vue = require('vue');

Vue.component('google-pay', require('./components/GooglePayButton.vue').default);
Vue.component('token-selector', require('./components/TokenSelector.vue').default);
Vue.component('pm-selector', require('./components/PMSelector.vue').default);

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
        validation: {
            valid: false,
            error: null,
            el: null,
        },
        lastPrice: window.lastPrice,
        settings: window.settings,
        fiat: window.fiat,
        App: null
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
        },
    },
    methods: {
        validate: function(currentStep) {
            console.log('Validating...');
            let  ids;
            switch (currentStep) {
                case 1:
                    let amountEl = document.getElementById('fiat_amount');
                    this.validation.valid = amountEl.validity.valid;
                    this.validation.error = amountEl.validationMessage;
                    break;
                case 2:
                    let username = document.getElementById('crea_username');
                    this.validation.valid = username.validity.valid;
                    this.validation.error = username.validationMessage;
                    break;
                case 3:
                    ids = ['email', 'address', 'phone', 'zip_code', 'name', 'state', 'surname', 'country', 'birth_date'];

                    for (let x = 0; x < ids.length; x++) {
                        let id = ids[x];
                        let el = document.getElementById(id);
                        if (!el.validity.valid) {
                            this.validation.valid = el.validity.valid;
                            this.validation.error = el.validationMessage;
                            this.validation.el = id;
                            break;
                        }
                    }
                    break;
                case 4:
                    ids = ['check_tos', 'check_username'];

                    for (let x = 0; x < ids.length; x++) {
                        let id = ids[x];
                        let el = document.getElementById(id);
                        if (!el.validity.valid) {
                            this.validation.valid = el.validity.valid;
                            this.validation.error = el.validationMessage;
                            this.validation.el = id;
                            break;
                        }
                    }


            }
        },
        nextStep: function (currentStep) {
            this.validate(currentStep);

            if (this.validation.valid && !this.validation.error) {
                this.step = ++currentStep;
            }
        },
        backStep: function (currentStep) {
            this.validation.valid = true;
            this.validation.error = null;
            this.validation.el = null;
            this.step = --currentStep;
        },
        onPaymentMethodChange: function (newPm) {
            this.form.payment_method = newPm;
        },
        onTokenChange: function (newToken) {
            this.App.fetchPrice(newToken, 'eur')
        },
        submitForm: function () {
            this.validate(4);
            if (this.validation.valid && !this.validation.error) {
                if (this.form.payment_method === 'card') {
                    $('#buyForm').submit();
                    return false;
                } else {
                    return true;
                }
            }

            return false;
        }
    }
});


setTimeout(function () {

    buyProcess.App = App;
    App.on('price.update', function (currency, counterCurrency, price) {
        buyProcess.lastPrice = price;
    });
});

