
const Vue = require('vue');

Vue.component('google-pay', require('./components/GooglePayButton.vue').default);

new Vue({
    el: '#buy-process',
    data: {
        step: 1,
        form: {
            amount: 1,
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
        }
    }
});
