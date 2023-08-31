var latitude  = '';
var longitude = '';
$('.business_category').prop('checked');
$( document ).ready(function() {
    category_ids = [];
        $('#deal-container').html('')
        $('#vendor_list_container').html('');
        $('.business_category:checked').each( function(){
            category_ids.push($(this).val());
        })
        getCommunity(category_ids)



    $("#settingModal").click(function(){
      $(".category-text").toggleClass("active");
    });

    $('.business_category').on('change',function(e){
        e.preventDefault();
        category_ids = [];
        $('#deal-container').html('')
        $('#vendor_list_container').html('');
        $('.business_category:checked').each( function(){
            category_ids.push($(this).val());
        })
        getCommunity(category_ids)
    })
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition,positionError);
    } else {
        console.info('Geolocation is not supported by this browser.')
        getCommunity();
    }
});

function positionError(error)
{
    getCommunity();
}

function showPosition(position)
{
    latitude  = position.coords.latitude;
    longitude = position.coords.longitude;
    getCommunity([],latitude,longitude);
}

function getCommunity(category_ids=[], lat='', long='' )
{
    let params = {
        action: 'community',
        promote_category:category_ids,
        paid_promotion: [1,0],
        latitude:lat,
        longitude:long,
        radius:50,
        limit:1000
    }
    ajax_request(base_url + '/action','GET',params).then( (res) => {
        $('#deal-container').html(res.html)
    })
}
