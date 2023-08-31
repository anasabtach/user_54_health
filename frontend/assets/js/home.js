$( document ).ready(function() {
    $("#viewBrand").click(function(){
        window.location.href = "/participating-businesses.html";
    });
    //get quote
    let quote_params = {
        action: 'get-quote'
    }
    ajax_request(base_url + '/action','GET',quote_params).then( (res) => {
        if( typeof res.data.description != 'undefined' ){
            $('#_quote_container').html(`
                <div class="img-text-box">
                    <h1 class="text-center">
                        ${ res.data.description }
                    </h1>
                </div>
            `)
        } else {
            $('#_quote_container').html('');
        }
    })
    //get vendors
    let vendor_params = {
        action: 'vendors-map',
        limit: 10,
        sort_column: 'id',
        sort_order: 'desc'
    }
    ajax_request(base_url + '/action','GET',vendor_params).then( (res) => {
        if( res.data.length > 0 ){
            for( var i=0; i < res.data.length; i++ ){
                let vendor_html = `<div class="feature-img-box">
                                    <a href="${ base_url + '/brand/detail/' + res.data[i].slug }">
                                        <img style="width:150px; height:100px; object-fit:contain;" src="${ res.data[i].image_url }" title="${res.data[i].name}" alt="${res.data[i].name}" class="img-fluid">
                                    </a>
                                </div>`;
                if( i <= 4 ){
                    $('#_vendor_container_1').append(vendor_html)
                }
                if( i > 4 && i <= 9 ){
                    $('#_vendor_container_2').append(vendor_html)
                }
            }
        }
    })
});
