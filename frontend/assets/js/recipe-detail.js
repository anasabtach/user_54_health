$( document ).ready(function() {

    // This button will increment the value
    $('[data-quantity="plus"]').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('data-field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
    // This button will decrement the value till 0
    $('[data-quantity="minus"]').click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('data-field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });

    //make favourite
    $('#_make_favourite').click( function(e){
        e.preventDefault();
       if( auth == null || auth == '' ){
            alert('Please login to continue');
       } else {
            let params = {
                action: 'make-favourite-deal',
                deal_id:$(this).data('id'),
            }
            ajax_request(base_url + '/action','GET',params).then( (res) => {
                if( res.code != 200 ){
                    alert( res.message );
                } else {
                    $(this).toggleClass("active");
                }

            })

       }
    });
    
    
       $("#redeemedModal").click(function(e){
  //     alert();
        let params = {
                action: 'deal_redeem',
                deal_id: $(this).data('id'),
                redeem_code: '12345'
            };
       
        ajax_request(base_url + '/action','GET',params).then( (res) => {
              //  $('#overlay').hide();
           //     $('button').removeAttr('disabled');
            //    $('input[type="submit"]').removeAttr('disabled');
                if( res.code == 400 ){
                    validation_messages = '<div class="alert alert-danger">';
                    for (const [key, value] of Object.entries(res.data)) {
                        validation_messages += `<p>${value}</p>`;
                    }
                    validation_messages += '</div>';
                    $('#_success_dev').addClass( 'd-none' );
                    $('#_error_div').html(validation_messages);
                    $('#_error_div').removeClass('d-none');
                } else {
                    $('#_error_div').addClass('d-none');
                    $('#_success_dev').html( '<div class="alert alert-success">' + res.message + '</div>' );
                    $('#_success_dev').removeClass( 'd-none' );
                    setTimeout( function(){
                      
                        $('#_success_dev').addClass( 'd-none' );
                    },3000 )

                }
            })
            
            
        
    });
    
    
    
    

    //deal redeem
    $('#_deal_redeem').click( function(e){
        e.preventDefault();
        let validation_messages;
        let deal_code = $('#deal_code').val();
        if( auth == null || auth == '' ){
            validation_messages = '<div class="alert alert-danger">Please login to continue</div>';
            $('#_success_dev').addClass( 'd-none' );
            $('#_error_div').html(validation_messages);
            $('#_error_div').removeClass('d-none');
       } else if ( deal_code == '' || deal_code == null ){
            validation_messages = '<div class="alert alert-danger">Redeem code is required</div>';
            $('#_success_dev').addClass( 'd-none' );
            $('#_error_div').html(validation_messages);
            $('#_error_div').removeClass('d-none');
       } else {
            $('#overlay').show();
            $('button').attr('disabled','disabled');
            $('input[type="submit"]').attr('disabled','disabled');
            let params = {
                action: 'deal_redeem',
                deal_id: $(this).data('id'),
                redeem_code: deal_code
            };
            ajax_request(base_url + '/action','GET',params).then( (res) => {
                $('#overlay').hide();
                $('button').removeAttr('disabled');
                $('input[type="submit"]').removeAttr('disabled');
                if( res.code == 400 ){
                    validation_messages = '<div class="alert alert-danger">';
                    for (const [key, value] of Object.entries(res.data)) {
                        validation_messages += `<p>${value}</p>`;
                    }
                    validation_messages += '</div>';
                    $('#_success_dev').addClass( 'd-none' );
                    $('#_error_div').html(validation_messages);
                    $('#_error_div').removeClass('d-none');
                } else {
                    $('#_error_div').addClass('d-none');
                    $('#_success_dev').html( '<div class="alert alert-success">' + res.message + '</div>' );
                    $('#_success_dev').removeClass( 'd-none' );
                    setTimeout( function(){
                        $('#redeemedModal').modal('hide');
                        $('#deal_code').val('');
                        $('#_success_dev').addClass( 'd-none' );
                    },3000 )

                }
            })
       }
    })

    //get related products
    let paid_promotion = deal_type == 0 ? ['0'] : ['1'];
    let params = {
        action: 'related-deals',
        paid_promotion: paid_promotion,
        user_id:deal_user_id,
        limit:4
    }
    ajax_request(base_url + '/action','GET',params).then( (res) => {
        if( res.html == null || res.html == '' ){
            $('#related_deal_section').remove();
        }else{
            $('#deal-container').html(res.html)
        }
    })
});
