let map;
$(document).ready( function(){
    let params = {
        action: 'vendor-deals',
        paid_promotion: [1,0],
        user_id:deal_user_id,
        status:'1'
    }
    ajax_request(base_url + '/action','GET',params).then( (res) => {
        $('#deal-container').html(res.html)
    })
    //review
    let review_param = {
        action: 'vendor-review',
        user_id:deal_user_id
    }
    ajax_request(base_url + '/action','GET',review_param).then( (res) => {
        $('#review_container').html(res.html)
    })
})

function initMap()
{
    let myLatLng = { lat: parseFloat(vendor_lat), lng: parseFloat(vendot_lng) };
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 13,
        center: myLatLng
    });
    new google.maps.Marker({
        position: myLatLng,
        map,
        title: vendor_name,
      });
}

