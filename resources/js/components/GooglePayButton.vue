<template>
    <div id="payment-request-button" class="font-14 btn btn-primary text-uppercase font-weight-bold w-100">

    </div>
</template>

<script>
    export default {
        name: "GooglePayButton",
        props: ['pk_key', 'sk_key', 'amount', 'country'],
        mounted: function () {
            let stripe = Stripe(this.pk_key);
            let paymentRequest = stripe.paymentRequest({
                country: 'ES',
                currency: 'eur',
                total: {
                    label: 'OneComet',
                    amount: this.amount * 100
                },
                requestPayerName: false,
                requestPayerEmail: false,
            });

            let elements = stripe.elements();
            let prButton = elements.create('paymentRequestButton', {
                paymentRequest: paymentRequest,
                style: {
                    paymentRequestButton: {
                        type: 'buy'
                    }
                }
            });

            paymentRequest.canMakePayment()
                .then( (result) => {
                    if (result) {
                        prButton.mount('#payment-request-button');
                    } else {
                        console.error(result)
                    }
                });

            paymentRequest.on('paymentmethod', (ev) => {
                stripe.confirmPaymentIntent(this.sk_key, {
                    payment_method: ev.paymentMethod.id,
                }).then((confirmResult) => {
                    if (confirmResult.error) {
                        // Report to the browser that the payment failed, prompting it to
                        // re-show the payment interface, or show an error message and close
                        // the payment interface.
                        ev.complete('fail');
                    } else {
                        // Report to the browser that the confirmation was successful, prompting
                        // it to close the browser payment method collection interface.
                        ev.complete('success');
                        // Let Stripe.js handle the rest of the payment flow.
                        stripe.handleCardPayment(this.sk_key).then(function(result) {
                            console.log(result);
                            if (result.error) {
                                // The payment failed -- ask your customer for a new payment method.
                            } else {
                                // The payment has succeeded.
                            }
                        });
                    }
                });
            });
        }
    }
</script>