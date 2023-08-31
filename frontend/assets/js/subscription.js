$(document).ready( function(){

    $('._subscription_btn').click( function(e){
        e.preventDefault();
        var package_id = $(this).data('package');
        $('input[name="package_id"]').val(package_id);
        $('#subscription_modal').modal('show');
    })

    var stripe = Stripe(STRIPE_PUBLISHED_KEY);
    var elements = stripe.elements('');
    // Create an instance of the card Element.
    var card = elements.create('card',{
        style: {
            base: {
                iconColor: '#c4f0ff',
                color: 'black',
                fontWeight: '500',
                fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
                fontSize: '16px',
                fontSmoothing: 'antialiased',
                ':-webkit-autofill': {
                    color: '#ccc',
                },
                '::placeholder': {
                    color: '#ccc',
                },
            },
                invalid: {
                iconColor: '#212121',
                color: '#212121',
            },
        }
    });
    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Create a token or display an error when the form is submitted.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        loaderBar();
        $('button').attr('disabled','disabled')
        event.preventDefault();
        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Inform the customer that there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
                $('button').removeAttr('disabled')
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
        });
    });
    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'card_token');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
        // Submit the form
        form.submit();
    }
})
