let map,
    markerClusterer = null,
    markers = [],
    category_ids = [],
    latitude='',
    longitude='',
    search_keyword;

$(document).ready(function () {

    $("#settingModal").click(function () {
        $(".category-text").toggleClass("active");
    });

    $(document).on('click', '._vendor', function (e) {
        e.preventDefault();
        let vendor_lat = $(this).data('lat');
        let vendor_lng = $(this).data('lng');
        if (vendor_lat != '' && vendor_lat != null && vendor_lng != '' && vendor_lng != '') {
            map.setCenter(new google.maps.LatLng(vendor_lat, vendor_lng));
            map.setZoom(13);
        }
    })

    $('#search-map').click(function (e) {
        e.preventDefault();
        //load vendor by name
        search_keyword = $('#_map_search').val();
        if (search_keyword.length > 0) {
            //remove markers
            removeMarkers();
            markers = [];
            $('#vendor_list_container').html('<p>Searching</p>');
            loadVendors(search_keyword,[],latitude,longitude);
        }
    })

    $('.business_category').on('change', function (e) {
        e.preventDefault();
        category_ids = [];
        removeMarkers();
        markers = [];
        $('#vendor_list_container').html('');
        $('.business_category:checked').each(function () {
            category_ids.push($(this).val());
        })
        loadVendors(search_keyword, category_ids, latitude, longitude)
        $('.map-category-text').removeClass('active')
    })
})

function loadVendors(name = null, business_category=[], lat='', long='') {
    let vendor_params = {
        action: 'vendors-map',
        promote_category: business_category,
        name: name,
        latitude: lat,
        longitude: long,
        limit: 1000
    };
    ajax_request(base_url + '/action', 'GET', vendor_params).then((res) => {
        let vendor_list_html = ``;
        if (res.data.length > 0) {
            let vendors = res.data;
            for (var i = 0; i < vendors.length; i++) {
                vendor_list_html += vendorHtml(vendors[i]);
            }
            //show marker on map
            mapMarkers(vendors);
            //vendor list show
            $('#vendor_list_container').html(vendor_list_html);
        } else {
            $('#vendor_list_container').html(`<div class="alert alert-info">No Data Found</div>`);
        }
    })
}
function mapMarkers(vendors) {
    var infowindow = new google.maps.InfoWindow();
    var marker, i;
    for (i = 0; i < vendors.length; i++) {
        let vendor = vendors[i];
        marker = new google.maps.Marker({
            position: { lat: parseFloat(vendor.latitude), lng: parseFloat(vendor.longitude) },
            map: map
        });

        markers.push(marker);

        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
                let info_html = `
            <div>
                <h6>${vendor.name}</h6>
                <div style="margin-top:20px;">
                    <p>Address: ${vendor.address}</p>
                    <p style="margin-top:10px;">Working Hours:</p>
                    <p>Mon - Sun</p>
                    <p>${vendor.open_time} - ${vendor.close_time}</p>
                </div>
            </div>
          `;
                infowindow.setContent(info_html);
                infowindow.open(map, marker);
            }
        })(marker, i));

    }
}

function removeMarkers() {
    if (markers.length > 0) {
        for (let i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }
    }
}

function vendorHtml(vendor) {
    let rating_html = ``;
    for (var r = 1; r <= 5; r++) {
        if (vendor.total_rating >= r) {
            rating_html += `<img src="${base_url}/frontend/assets/img/Star.png" alt="star-img" class="img-fluid">`;
        } else {
            rating_html += `<img src="${base_url}/frontend/assets/img/Star-light.png" alt="star-img-light" class="img-fluid">`;
        }
    }
    let business_category_html = '';
//     if (vendor.business_category_id != 0 && vendor.business_category_id != null) {
//         business_category_html += `<img src="${base_url}/frontend/assets/img/noun-food.png" alt="noun-food" class="img-fluid">
//                                     <span class="font-8">${ vendor.business_category.title }</span>`;
//     }
    let vendor_list_html = `<a style="cursor:pointer;" data-lat="${vendor.latitude}" data-lng="${vendor.longitude}" class="_vendor">
                                <div class="resturent-name d-flex align-items-center border-2-solid ">
                                    <div class="img-of-resturent">
                                        <img src="${vendor.image_url}" alt="resturent-img" class="img-fluid">
                                    </div>
                                    <div class="text-resturent">
                                        <p class="mt-1 font-medium">${vendor.name}</p>
                                        <p class="mar-1">
                                            ${rating_html}
                                            <span class="font-8 "> (${vendor.total_review > 1 ? vendor.total_review + ' reviews' : vendor.total_review + ' review'})</span>
                                        </p>
                                        <p class="mar-1">
                                            <span>
                                                ${business_category_html}
                                                <span>
                                                    <img src="${base_url}/frontend/assets/img/Location.png" alt="Location" class="img-fluid ">
                                                </span>
                                                <span class="font-8">${vendor.city}</span>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </a>`;
    return vendor_list_html;

}

function initMap() {
    let myLatLng = { lat: 44.500000, lng: -89.500000 };
    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 5,
        center: myLatLng
    });
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition,positionError);
    } else {
        console.info('Geolocation is not supported by this browser.')
        loadVendors();
    }
}

function positionError(error)
{
    loadVendors();
}

function showPosition(position)
{
    latitude  = position.coords.latitude;
    longitude = position.coords.longitude;
    loadVendors(null,[],latitude,longitude);
}
