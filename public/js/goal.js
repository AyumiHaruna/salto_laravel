var acc = document.getElementsByClassName("accordion");
var i;
var editMode = false;

function goalBindHandlersReset(){
    $('.click_checkbox').unbind('click');
    $('.edit_goal_button').unbind('click');
    $('.goal_text').unbind('mouseover');
    $('.goal_text').unbind('mouseout');
    $('.goal_text_guardar').unbind('click');

    //--//
    $('.click_checkbox').bind('click', function(){
        if(editMode == true || $(this).attr('data-id') == null){
            return;
        }
        var completed = 0;
        var currentElement = this;
        if($(this).children('input')[0].checked){
            completed = 1;
        }
        var data = { completed: completed,
                     id: $(this).attr('data-id')
                   }

        console.log(route_update_goal_completed);
        $.ajax({
            headers : {'X-CSRF-TOKEN': token },
            dataType: "json",
            data    : data,                   // Pass IDs array
            url     : route_update_goal_completed,
            type    : 'post',                       // Send a delete request

            beforeSend: function () {
            },

            success: function (msg) {
              console.log(msg);
                if(msg.status == '200'){

                }else{
                    // alert(msg.msg);
                }
            },

            error: function (xhr, err) {
                alert("Al parecer hubo un problema, inténtalo más tarde.");
            }
        });
    });

    $('.edit_goal_button').bind('click', function(e){
        editMode = true;
        $(this).parent().find('div.goal_text_input').find('input').val($(this).parent().find('p.goal_text_paragraph').html());
        $(this).parent().find('p.goal_text_paragraph').hide();
        $(this).parent().find('div.goal_text_input').show();
        e.preventDefault();
        });
    $('.goal_text').bind('mouseover', function(){
        if(!editMode){
            $(this).find('.edit_goal_button').show();
        }
    });
    $('.goal_text').bind('mouseout', function(){
        $(this).find('.edit_goal_button').hide();
    });

    //--//
    $('.goal_text_guardar').bind('click', function(e){
        var completed = 0;
        var currentElement = this;
        if($(this).parent().parent().children('input')[0].checked){
            completed = 1;
        }
        var data = { description: $(this).parent().find('input.goal_text_textarea').val(),
                     completed: completed,
                     type: $(this).parent().parent().parent().parent().attr('data-type'),
                     date: $(this).parent().parent().parent().parent().attr('data-date'),
                     id: $(this).parent().parent().attr('data-id')
                   }
        console.log(route_update_goal);
        $.ajax({
            headers : {'X-CSRF-TOKEN': token },
            dataType: "json",
            data    : data,                   // Pass IDs array
            url     : route_update_goal,
            type    : 'post',                       // Send a delete request

            beforeSend: function () {
            },

            success: function (msg) {
              console.log(msg);
                if(msg.status == '200'){
                    editMode = false;
                    if(msg.deleted == '1'){
                        $(currentElement).parent().parent().remove();
                    }else{
                        $(currentElement).parent().parent().find('div.goal_text_input').hide();
                        $(currentElement).parent().parent().find('p.goal_text_paragraph').html($(currentElement).parent().parent().find('div.goal_text_input input').val());
                        $(currentElement).parent().parent().find('p.goal_text_paragraph').show();
                        $(currentElement).parent().parent().attr('data-id', msg.id);
                    }

                }else{
                    alert(msg.msg);
                }
                $('#goal_vision_text_paragraph').show();
            },

            error: function (xhr, err) {
                alert("Al parecer hubo un problema, inténtalo más tarde.");
            }
        });
        e.preventDefault();
    });
}

$('.goal_add').bind('click', function(){
        var newItem = '<label class="container goal_text click_checkbox"><p class="goal_text_paragraph"></p><input type="checkbox"><span class="checkmark"></span><div class="edit_goal_button"><img src="'+editImage_url+'" /></div><div class="goal_text_input"><input type="text" class="goal_text_textarea" value="" placeholder="Escribe tu meta."></input><a class="goal_text_guardar">Guardar</a></div></label>';
        $(newItem).insertBefore($(this));
        $(this).parent()[0].style.maxHeight = $(this).parent()[0].scrollHeight + "px";
        goalBindHandlersReset();
    });



for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight){
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}
$('#goal_vision_header_edit').bind('click', function(){
    $('#goal_vision_text_paragraph').hide();
    $('#goal_vision_text_textarea').val($('#goal_vision_text_paragraph').html());
    $('#goal_vision_text_input').show();

});

//--//
$('#goal_vision_text_guardar').bind('click', function(){
    $('#goal_vision_text_input').hide();
    var vision = $('#goal_vision_text_textarea').val();
    console.log(route_update_vision);
    $.ajax({
        headers : {'X-CSRF-TOKEN': token },
        dataType: "json",
        data    : { vision: vision },                   // Pass IDs array
        url     : route_update_vision,
        type    : 'post',                       // Send a delete request

        beforeSend: function () {
        },

        success: function (msg) {
            console.log(msg);
            if(msg.status == '200'){
                $('#goal_vision_text_paragraph').html(msg.vision);

            }else{
                alert(msg.msg);
            }
            $('#goal_vision_text_paragraph').show();
        },

        error: function (xhr, err) {
            alert("Al parecer hubo un problema, inténtalo más tarde.");
        }
    });
});

goalBindHandlersReset();
