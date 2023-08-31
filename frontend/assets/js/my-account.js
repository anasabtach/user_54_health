$( document ).ready(function() {

    $('.my-account-sec').removeClass('d-none')

    $('#historyBtn').on("click", function(e){
        $("#v-pills-suscribe").addClass("active show");
        $("#v-pills-settings").removeClass("active show");
    });
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });
    $('#_upload_image,._upload_image').click( function(){
        $('#image_url').click();
    })
    $('#image_url').change( function(event){
        var output = document.getElementById('_upload_image');
        output.src = URL.createObjectURL(event.target.files[0]);
    })
    $('.nav-link').click( function(){
        $('.alert').hide();
    })
    $('form').submit( function(){
        $('button').attr('disabled','disabled');
        $('input[type="submit"]').attr('disabled','disabled');
        loaderBar()
    })
    $('[data-toggle="tooltip"]').tooltip()

    //get favourite
    let favourite_params = {
        action: 'get-favourite-deal',
        is_favourite:1
    }
    ajax_request(base_url + '/action','GET',favourite_params)
        .then( (res) => {
            $('#favourite_container').html(res.html);
        })
    //notification setting
    $('input[name="notification_setting"]').click( function(e){
        let params = {
            action: 'notification-setting',
            notification_setting: $(this).is(':checked') ? '1' : '0'
        }
        ajax_request(base_url + '/action','GET',params).then( (res) => {
            console.log('res',res);
        })
    })

    //get content
    let content_params = {
        action: 'content',
    }
    ajax_request(base_url + '/action','GET',content_params).then( (res) => {
        $('#_terms_conditions').append(res.data['terms-condition']);
        $('#_privacy_policy').append(res.data['privacy-policy']);
        $('#_faq_').append(res.data.faq);
    });

    //referral history
    let referral_params = {
        action: 'referral_history'
    };
    ajax_request(base_url + '/action','GET',referral_params).then( (res) => {
        $('#referral_history').html(res.html);
    });

    //subscription
    subscription()

    //subscription history
    let subscription_history_params = {
        action: 'subscription_history'
    };
    ajax_request(base_url + '/action','GET',subscription_history_params).then( (res) => {
        $('#_subscription_history_param').append(res.html);
    });
});

function subscription()
{   
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

    // var stripe = Stripe(STRIPE_PUBLISHED_KEY);
    // var elements = stripe.elements();
    // var style = {
    //     base: {
    //         color: '#32325d',
    //         fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    //         fontSmoothing: 'antialiased',
    //         fontSize: '16px',
    //         '::placeholder': {
    //             color: '#aab7c4'
    //         }
    //     },
    //     invalid: {
    //         color: '#fa755a',
    //         iconColor: '#fa755a'
    //     }
    // };
    // var card = elements.create('card', {hidePostalCode: true,
    //     style: style});
    // card.mount('#card-element');
    // card.addEventListener('change', function(event) {
    //     var displayError = document.getElementById('card-errors');
    //     if (event.error) {
    //         displayError.textContent = event.error.message;
    //     } else {
    //         displayError.textContent = '';
    //     }
    // });
    // const cardHolderName = document.getElementById('card-holder-name');
    // const cardButton = document.getElementById('card-button');
    // const clientSecret = cardButton.dataset.secret;
    // cardButton.addEventListener('click', async (e) => {
    //     console.log("attempting");
    //     e.preventDefault();
    //     const { setupIntent, error } = await stripe.confirmCardSetup(
    //         clientSecret, {
    //             payment_method: {
    //                 card: card
    //                 // billing_details: { name: cardHolderName.value }
    //             }
    //         }
    //         );
    //     if (error) {
    //         var errorElement = document.getElementById('card-errors');
    //         errorElement.textContent = error.message;
    //     } else {
    //         paymentMethodHandler(setupIntent.payment_method);
    //     }
    // });
    // function paymentMethodHandler(payment_method) {
    //     var form = document.getElementById('payment-form');
    //     var hiddenInput = document.createElement('input');
    //     hiddenInput.setAttribute('type', 'hidden');
    //     hiddenInput.setAttribute('name', 'payment_method');
    //     hiddenInput.setAttribute('value', payment_method);
    //     form.appendChild(hiddenInput);
    //     form.submit();
    // }
}
