let progress_bar = 30;
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        'token': $('meta[name="token"]').attr('content'),
        "user-token": $('meta[name="auth"]').attr('content'),
    }
});
$('from').submit(function(){
    $('button').attr('disabled','disabled')
    $('input[type="submit"]').attr('disabled','disabled');
});
$('.alert, .error_div, .success_div').click(function(){
    $(this).fadeOut('slow');
})
$('.dropdown-menu').on('click',function(event){
    event.stopPropagation()
})
var ajax_form_submitted = (form='#_form' ,error_element='#_error_div', success_element='#_success_dev') => {
    $(document).on('submit',form,function(e){
        e.preventDefault();
        var form_ele = $(this);
        $(error_element).hide();
        $(success_element).hide();
        var formData = new FormData($(this)[0]);
        $.ajax({
            type: $(this).attr('method'),
            url: $(this).attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $('#overlay').show();
                $('button').attr('disabled','disabled');
                $('input[type="submit"]').attr('disabled','disabled');
            },
            success: function(data){
                $('#overlay').hide();
                $('button').removeAttr('disabled');
                $('input[type="submit"]').removeAttr('disabled');
                if( data.error ){
                    var error_html = '<div class="alert alert-danger">';
                    for( var key in data.data ){
                        error_html += '<p>'+ data.data[key] +'</p>';
                    }
                    error_html += '</div>';
                    $(error_element).html(error_html);
                    $(error_element).show();
                } else {
                    $(form)[0].reset();
                    var success_html = '<div class="alert alert-success">'+ data.message +'</div>';
                    $(success_element).html(success_html);
                    $(success_element).show();
                }
            },
            error: function(jqXHR, exception){
                $('#overlay').hide();
                $('button').removeAttr('disabled');
                $('input[type="submit"]').removeAttr('disabled');
                if (jqXHR.status === 0) {
                    alert('Not connect.\n Verify Network.');
                } else if (jqXHR.status == 404) {
                    alert('Requested page not found. [404]');
                } else if (jqXHR.status == 500) {
                    alert('Internal Server Error [500].');
                } else if (exception === 'parsererror') {
                    alert('Requested JSON parse failed.');
                } else if (exception === 'timeout') {
                    alert('Time out error.');
                } else if (exception === 'abort') {
                    alert('Ajax request aborted.');
                } else {
                    alert('Uncaught Error.\n' + jqXHR.responseText);
                }
            }
        });
    })
}
var googleAutoComplete = (addressField='address') => {
    const address = document.getElementById(addressField);
    const autocomplete = new google.maps.places.Autocomplete(address);

    autocomplete.addListener("place_changed", () => {
        const place = autocomplete.getPlace();
        var lat = place.geometry.location.lat();
        var long = place.geometry.location.lng();
        $('input[name="longitude"]').val(long);
        $('input[name="latitude"]').val(lat);
        if ( place.address_components ) {
            for( var index in place.address_components ){
                if( place.address_components[index].types[0] == 'administrative_area_level_1' ){
                    $('input[name="state"]').val(place.address_components[index].short_name)
                }
                if( place.address_components[index].types[0] == 'locality' ){
                    $('input[name="city"]').val(place.address_components[index].short_name)
                }
                if( place.address_components[index].types[0] == 'postal_code' ){
                    $('input[name="zipcode"]').val(place.address_components[index].short_name)
                }
            }
        }
    });
}
var ajax_request = (url, method, params = {}) => {
    return new Promise( (resolve,reject) => {
        $.ajax({
            type: method,
            url: url,
            data: params,
            beforeSend: function(){
                $('button').attr('disbaled','disabled');
                $('input[type="submit"]').attr('disabled','disabled');
            },
            success: function(data){
                if( data.code == 401 ){
                    alert(data.data.auth);
                    window.location.href = base_url + '/logout';
                    return;
                }
                $('button').removeAttr('disabled');
                $('input[type="submit"]').removeAttr('disabled');
                resolve(data);
            },
            error: function(jqXHR, exception) {
                if (jqXHR.status === 0) {
                    alert('Not connect.\n Verify Network.');
                } else if (jqXHR.status == 404) {
                    alert('Requested page not found. [404]');
                } else if (jqXHR.status == 500) {
                    alert('Internal Server Error [500].');
                } else if (exception === 'parsererror') {
                    alert('Requested JSON parse failed.');
                } else if (exception === 'timeout') {
                    alert('Time out error.');
                } else if (exception === 'abort') {
                    alert('Ajax request aborted.');
                } else {
                    alert('Uncaught Error.\n' + jqXHR.responseText);
                }
            }
        });
    })
}
var encryptData = (key,iv,data) => {
    var key = CryptoJS.enc.Utf8.parse(key);
    var iv =  CryptoJS.enc.Utf8.parse(iv);
    var ciphertext = CryptoJS.AES.encrypt(data,key,{iv:iv}).toString();
    return ciphertext;
}
var loaderBar = () => {
    $.skylo('start');
    let setInter = setInterval(function () {
        if( progress_bar > 80 ){
            clearInterval(setInter)
        }
        $.skylo('set',progress_bar > 80 ? 100 : progress_bar);
        progress_bar +=1
    }, 100);
}
