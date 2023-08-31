$( document ).ready(function() {
    $('#_upload_image').click( function(){
        $('#image_url').click();
    })
    $('#image_url').change( function(event){
        var output = document.getElementById('_upload_image');
        output.src = URL.createObjectURL(event.target.files[0]);
    })
    $('[data-toggle="tooltip"]').tooltip()
});
