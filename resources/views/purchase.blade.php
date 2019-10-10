<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <script src="https://js.stripe.com/v3/"></script>
    </head>
    <body>
    <script>
        const stripe = Stripe('{{ env('STRIPE_PUBLIC_KEY') }}');
        stripe.redirectToCheckout({
            // Make the id field from the Checkout Session creation API response
            // available to this file, so you can provide it as parameter here
            // instead of the CHECKOUT_SESSION_ID placeholder.
            sessionId: '{{ $stripeSession->id }}'
        }).then(function (result) {
            // If `redirectToCheckout` fails due to a browser or network
            // error, display the localized error message to your customer
            // using `result.error.message`.
        });
    </script>
    </body>
</html>
