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


function checkCheckboxesChecked(){
    var checkedCheckboxes = $('#page-content').find("input[type=checkbox]");
    returnValue = false;
    checkedCheckboxes.each(function(){
        if($(this).prop('checked')){
             returnValue = true;
        }
    });
    return returnValue;
}

function triggerMenuChange(selector){
    if(checkCheckboxesChecked()){
        $(selector).trigger('contentON')
    }else{
        $(selector).trigger('contentOFF')
    }
}
function turnAllCheck(status){
    var checkedCheckboxes = $('#page-content').find("input[type=checkbox].checkbox-object");
    var value = '';
    if(status == 'on'){
        value = true;
    }else{
        value = false;
    }
    
    checkedCheckboxes.each(function(){
        $(this).prop('checked', value);
    });
    triggerMenuChange('#plus_icon');
}
function deleteUsers()
    {
        var $roles = [];

        $("input:checkbox[name=object]:checked").each(function(){
            $roles.push($(this).val());
        });

        $.ajax({
            headers : {'X-CSRF-TOKEN': token },
            dataType: "json",
            data    : { uids: $roles.join() },                   // Pass IDs array
            url     : route_company_destroy,
            type    : 'delete',                       // Send a delete request

            beforeSend: function () {
            },

            success: function (msg) {
                alert(msg.message);
                if(msg.code != 405)
                {
                    location.reload();
                }
            },

            error: function (xhr, err) {
                alert("Al parecer hubo un problema, inténtalo más tarde.");
            }
        });
    }

$('input[type=checkbox]').bind('change', function(){
    triggerMenuChange('#plus_icon');
    
});

$('#plus_icon').bind('click', function(){
     $('#addCompanyModal').modal('show');
 });
$('#close_icon').bind('click', function(){
    $('#main-select-all').prop('checked', false);
    turnAllCheck('off');
});
$('#garbage-button').bind('click', function(){
    deleteUsers();
});
$('.input-search-close').on('click',function(){
    $('#search').val('');
});
$('#main-select-all').bind('change', function(){
    if($(this).prop('checked')){
        turnAllCheck('on');
    }else{
        turnAllCheck('off');  
    }
    
});

$( "#submitAddCompanyForm" ).click(function() {
        $( "#addCompanyForm" ).submit();
});

$('.openEditCompanyModal').click(function(e)
    {
    var uid = $(this).data('uid');
    $td = $(this).parent().parent();

    if($('.alert').length > 0){
        $('.alert').remove();
    }
    $('#formuid').val('');
    $('#formName').val('');
    $('#formDisplayName').val('');
    $('#formDescription').val('');

    $('#company_edit').multiSelect('deselect_all');

    $.ajax({
        headers : {'X-CSRF-TOKEN': token },
        dataType: "json",
        data    : { uid: uid },
        url     : route_company_get_permiso,
        type    : 'GET',

        success: function (msg) {
            $('#overlayContainer').remove();
            $('#overlayContainer').fadeOut();

            

            if(msg.status == 200)
            {
                var categories = [];
                var $roles = [];

                $('#formuid').val(msg.role.id);
                $('#formName').val(msg.role.name);
                $('#formDisplayName').val(msg.role.display_name);
                
            }
        },

        error: function (xhr, err) {
            $('#overlayContainer').remove();
            $('#overlayContainer').fadeOut();
            $('#editCompanyModal').modal('hide');

            alertify.theme('bootstrap');
            // confirm dialog
            alertify.alert('Al parecer hubo un problema, inténtalo de nuevo.');
        }
    });
    $('#editCompanyModal').modal('show');
    e.stopPropagation();
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

$('#company').multiSelect();
$('#company_edit').multiSelect();
