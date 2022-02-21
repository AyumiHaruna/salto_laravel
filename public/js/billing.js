$('#plus_icon').bind('contentOFF', function(){
    $(this).show();
    $('#close_icon').hide();
    $('#garbage-button').fadeOut();
});

$('#plus_icon').bind('contentON', function(){
    $(this).hide();
    $('#close_icon').show();
    $('#garbage-button').fadeIn();
});
$('#plus_icon').bind('click', function(){
     $('#addCompanyModal').modal('show');
});
$('#garbage-button').bind('click', function(){
    deleteUsers();
});
$('.input-search-close').on('click',function(){
    $('#search').val('');
});

$('.table_header').bind('click', function(){
    $('.table_header').removeClass('selected');
    $(this).addClass('selected');
});


var loading = function() {
    if($('#overlayContainer').length > 0)
    {
        $('#overlayContainer').remove();
    }
    // add the overlay with loading image to the page
    var over = '<div id="overlayContainer">' +
            '<img id="loadingImage" src="{{ asset("images/loader.gif") }}">' +
            '</div>';
    $(over).appendTo('.modal-content').fadeIn();

    // click on the overlay to remove it
    //$('#overlay').click(function() {
    //    $(this).remove();
    //});

    // hit escape to close the overlay
    $(document).keyup(function(e) {
        if (e.which === 27) {
            $('#overlay').remove();
        }
    });
};
