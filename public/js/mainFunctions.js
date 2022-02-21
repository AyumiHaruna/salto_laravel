//Validate mail from Suscribe form (on footer)
function suscribeValidator()
{
  var mail = $("#sus-mail").val();
  var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;

  if( mail != '' ){
    if( pattern.test(mail) ){
      ajaxSendSuscribe();
    } else {
      showAlert('error', 'Formato de correo inválido');
      $("#sus-mail").focus();
    }
  } else {
    showAlert('error', 'Falta capturar el correo');
    $("#sus-mail").focus();
  }
}

// send mail to suscribe list
function ajaxSendSuscribe()
{
  $.ajax({
    data: { correo: $("#sus-mail").val() },
    type: "POST",
    url: SubscriptionUrl,
    beforeSend: function() {
      $("#susSubBtn").prop('disabled', true);
      $("#susSubBtn").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>');
    }
  })
  .done(function(data){
      console.log(data);
      console.log('ajaxSendSuscribe(ok)');
      if (data == 1) {
        $("#susSubBtn").prop('disabled', true);
        $("#susSubBtn").html('<i class="fas fa-check fa-lg"></i>');
        showAlert('ok', 'Te haz suscrito exitosamente');
      } else {
        $("#susSubBtn").prop('disabled', false);
        $("#susSubBtn").html('Enviar');
        showAlert('error', 'El correo ya ha sido registrado anteriormente');
      }
  })
  .fail(function(){
      $("#susSubBtn").prop('disabled', false);
      $("#susSubBtn").html('Enviar');
      showAlert('error', 'Ocurrió un error, reintentalo nuevamente');
      console.log('ajaxSendSuscribe("falló")');
  });
}

//show alert with error info
function showAlert(stat, msg)
{
  //remove font-color class
  $(".alertDiv").removeClass('textRed');
  $(".alertDiv").removeClass('textBlue');
  if( stat == 'ok' ){
    $(".alertDiv").addClass('textBlue');
    $(".alertDiv").html('<i class="fas fa-check-circle fa-lg"></i> &nbsp; '+msg);
    $(".alertDiv").show();
  } else if( stat == 'error' ){
    $(".alertDiv").addClass('textRed');
    $(".alertDiv").html('<i class="fas fa-exclamation-triangle fa-lg"></i> &nbsp;'+msg);
    $(".alertDiv").show();
  }
   setTimeout(function(){
    $(".alertDiv").hide();
  }, 3500);
}

$('#main_container ').css('padding-top', $('#mainNav').innerHeight());
window.onresize = function()
{
  resize();
}

function resize(){
  var header_height = $('.navbar').outerHeight();
  $('#main_container ').css('padding-top', $('#mainNav').innerHeight());
  $('.title-block').css('margin-top', header_height+'px');
}

//on hover transparenta texto
$( ".nav-link" ).hover(
  function() {
    $(this).fadeTo( "fast" , 0.7);
  }, function() {
    $(this).fadeTo( "fast" , 1);
  }
);


//abre y cierra el menú de hamburguesa
$(".navbar-toggler").on('click', function(){
  if( $('#navbarResponsive').hasClass('show') ){        //if navBar dropdown is shown,   remove it (close dropdown)
    $('#navbarResponsive').removeClass('show');
  } else {
    $('#navbarResponsive').addClass('show');        //else if navbar dropdown isn't shown, show it
  }
});


//  show & hide, "Aviso de privacidad"
$(".avisoPriv").on('click', function(){
  $("#avisoPrivBG").show();
});

$(".closeAviso").on('click', function(){
  $("#avisoPrivBG").hide();
})





//---------------------------------------------------------------
//
//                      CHAT FUNCTIONS
//
//---------------------------------------------------------------
var intervalChatLoading;

//submit messages from chat
function submit_chat_msg(){
  var msg = $("#chat_text_field").val();
  if (msg != '' && msg != null && msg != undefined ) {
      var msg = $("#chat_text_field").val();
      var role = $("#chat_hidden_role").val();
      var client = $("#chat_hidden_client").val();
      var support = $("#chat_hidden_support").val();
      var url = $("#chat_hidden_url").val();
      var token = $("#chat_hidden_token").val();
      console.log( 'submit_chat_msg' );

      url += '/msg_submit';

      $.ajax({
      data: { "_token": token,
              "msg": msg,
              "role": role,
              "client": client,
              "support": support,
            },
      type: "POST",
      url
      })
      .done(function(data){
        if(data.status == 200)    // message saved
        {
            ajax_get_chat_messages();
            $("#chat_text_field").val('');
        }
      })
      .fail(function(){
          console.log('error');
      });
  }
}

//if is texting on chat and press ENTER
$("#chat_text_field").keypress(function(event){
  if(event.keyCode == 13){
    submit_chat_msg();
  }
})

//on click in chat btn, start periodical ajax request for responses
$(".chat_title").click(function(){

  $(".chat_title").toggleClass('chatWindowActive');
  var role = $("#chat_hidden_role").val();

  if( $('.chat_title').hasClass('chatWindowActive') ){
    if( role == 5 ){      //if is client
        $(".chat_client_msgList_block").show();
        ajax_get_chat_messages();
        startChatLoading();
    } else {
      $("#chat_admin_upd_btn button").show()
      ajax_get_admin_chats();
      setTimeout(function(){
        $(".chat_client_msgList_block, .chat_admin_pendientes .title, .chat_admin_activas .title").show();
        $(".chat_client_msg_list").scrollTop( $(".chat_client_msg_list").prop("scrollHeight") );
      }, 200);
    }
  } else {
      $(".chat_client_msgList_block").hide();
      if (role == 5) {
        stopChatLoading();
      }
  }

});

//get new messages of chat
function ajax_get_chat_messages(){
  console.log('ajax_get_chat_messages');
  var client = $("#chat_hidden_client").val();
  var url = $("#chat_hidden_url").val();
  var role = $("#chat_hidden_role").val();
  var isClosed = 0;

  $.get( url + '/msg_get/'+client , function( data ) {
    if( data.status == 200 ){         //if there is a conversation print
      //asign chat id val
      $("#chat_hidden_id").val(data.thisId);

      for (var i = 0; i < data.data.length; i++) {        //search if theres new message to show
        // console.log( $('.chat_client_msg_list div:eq('+(i+1)+')').html() );
        // console.log( data.data[i]['msg'] );
        // console.log( '-----------------------' );
        if( $('.chat_client_msg_list').html() == '' )
        {
            $('.chat_client_msg_list').append('<div>&nbsp;</div>');
        }
        if( $('.chat_client_msg_list div:eq('+(i+1)+')').html() != data.data[i]['msg'] )
        {
            $('.chat_client_msg_list').append( "<div class='"+(( data.data[i]['role'] != $("#chat_hidden_role").val() )? "chat_right_msg" : "chat_left_msg" )+"'>"+data.data[i]['msg']+"</div>" );
        }
      }

      ($(".chat_client_msg_list")).scrollTop( ($(".chat_client_msg_list")).prop('scrollHeight') );        //scroll to chat bottom
    }           //end if status == 200
    else if( data.status == 204 )
    {
      if( $("#chat_hidden_id").val() != '' && $("#chat_hidden_id").val() != data.thisId ){
          isClosed = 1;
      }

      $("#chat_hidden_id").val(data.thisId);

      if( role == 5 && isClosed == 1  )           //close ticket
      {
          $('.chat_client_msg_list').append( "<div>-Conversación terminada</div>" );
          $('#chat_text_field').prop("disabled", true);
          stopChatLoading();
      }
    }
  });
}

//get list of pending and active chats
function ajax_get_admin_chats(){
  console.log( 'ajax_get_admin_chats' );
  var url = $("#chat_hidden_url").val();
  var support = $("#chat_hidden_support").val();

  $.get( url + '/admin_chats_get/'+support , function( data ) {
    console.log(data);
    var pendientes = data.data['pendientes'];
    var activos = data.data['activas']

    var listaPendientes = '<ul>';
    pendientes.forEach( function(element){
        listaPendientes +=    '<li type="pending" client_id="'+element.id_coachee+'" class="chatIndex">'+element.client_name+' '+((element.client_last_name != null)? element.client_last_name : '' )+'</li>';
    });
    listaPendientes +=    '</ul>';

    $(".chat_admin_pendientes .title span").html( (data.data['pendientes']).length );
    $(".chat_admin_pendientes .list").html(listaPendientes);

    var listaActivas =  '<ul>';
    activos.forEach( function(element){
        listaActivas +=      '<li type="active" client_id="'+element.id_coachee+'" class="chatIndex">'+element.client_name+' '+((element.client_last_name != null)? element.client_last_name : '' )+'</li>';
    });
        listaActivas += '</ul>';

    $(".chat_admin_activas .title span").html( (data.data['activas']).length );
    $(".chat_admin_activas .list").html(listaActivas);
    $('#chat_text_field').prop("disabled", true);
  });
}

//show pending or active chats list
$(".chat_admin_pendientes .title, .chat_admin_activas .title").click(function(){
  var selected = $(this).parent().attr('id');
  $("#"+selected).children('.list').toggleClass('showList');
})

//if click on chat_admin_list client
$(".chat_admin_pendientes, .chat_admin_activas").on("click", ".chatIndex", function(e){
    e.preventDefault();
    get_this_client_chats( $(this).attr('client_id'), $(this).attr('type'), $(this).html() );
});

//get chats from this client
function get_this_client_chats(client, type, client_name){
  console.log( 'get_this_client_chats' );
  var url = $("#chat_hidden_url").val();
  var support = $("#chat_hidden_support").val();
  var token = $("#chat_hidden_token").val();
  $("#chat_hidden_client").val(client);

  url += '/get_this_client_chats';
  $.ajax({
  data: { "_token": token,
          "type": type,
          "client": client,
          "support": support,
        },
  type: "POST",
  url
  })
  .done(function(data){
    console.log(data);
    if(data.status == 204) {
        showAlert('error', 'Este ticket ya ha sido atendido por otro coach');
    } else if( data.status == null ){
        showAlert('error', 'Ocurrió un error, inténtalo nuevamente');
    } else if( data.status == 200 ) {
        var chatList = $.parseJSON( data.data );
        var chatRecord = '';
        if ( Object.keys(chatList).length > 1 ) {
          for (var key in chatList) {
            if( key != data.last_chat_id ){
              chatRecord += '<div class="row">';
                chatRecord += '<div class="col-sm-12">';
                  chatRecord +=  'Conversación del: <b>'+chatList[key][0]['datetime']+'</b>';
                chatRecord += '</div>';
                for (var subkey in chatList[key]) {
                  chatRecord += '<div class="col-sm-12 '+ ((chatList[key][subkey]['role'] == 5 )? 'chat_right_msg' : 'chat_left_msg' ) +'">';
                    chatRecord +=  chatList[key][subkey]['msg'];
                  chatRecord += '</div>';
                }
              chatRecord += '</div>';
            }
          }
        } else {
          chatRecord = 'No se encontraron conversaciones previas de este usuario';
        }
        ajax_get_chat_messages();
        $(".old_chats_title").html('<b>'+client_name+'</b><br> (Historial de conversaciones)');
        $(".old_chats_record").html(chatRecord);
        ($(".chat_client_msg_list")).scrollTop( ($(".chat_client_msg_list")).prop('scrollHeight') );
        $(".chat_admin_msgList_block, .chat_admin_upd_btn button").hide();
        $(".chat_admin_msgList_old_chats, .chat_admin_back_btn button, #chat_btn_close").show();
        $('#chat_text_field').prop("disabled", false);
        startChatLoading();
    }
  })
  .fail(function(){
      // console.log('error');
      showAlert('error', 'Ocurrió un error, intentalo nuevamente');
  });
}

//back and update list of pending/actives chats
$("#chat_admin_back_btn button, #chat_admin_upd_btn button").click(function(){
    if( $(this).parent().attr('id') == 'chat_admin_back_btn' ){
      //hide back button and stop chat write/load
      $("#chat_admin_back_btn button, .chat_admin_msgList_old_chats, #chat_btn_close").hide();
      $("#chat_admin_upd_btn button, .chat_admin_msgList_block").show();
      $(".chat_client_msg_list").html('');
      $("#chat_text_field").val('');
      $('#chat_text_field').prop("disabled", true);
      stopChatLoading();
    }
    ajax_get_admin_chats();
})

function startChatLoading(){
  console.log('startChatLoading');
  intervalChatLoading = setInterval(function(){
    ajax_get_chat_messages();
  }, 5000);
}

function stopChatLoading(){
  clearInterval(intervalChatLoading);
  console.log('stopChatLoading');
}

//close ticket (change status 2)
function close_chat_ticket(){
    console.log( 'close_chat_ticket' );
    var url = $("#chat_hidden_url").val();
    var client = $("#chat_hidden_client").val();
    var token = $("#chat_hidden_token").val();
    var support = $("#chat_hidden_support").val();
    var role = $("#chat_hidden_role").val();
    url += '/close_chat_ticket';

    if (confirm('¿Desea cerrar este ticket?')){
      $.ajax({
      data: { "_token": token,
              "support": support,
              "role": role,
              "client": client,
            },
      type: "POST",
      url
      })
      .done(function(data){
        console.log(data);
        if(data.status == 200) {
          $("#chat_admin_back_btn button").trigger('click');
          $('.chat_client_msg_list').html( "<div>- Ticket cerrado -</div>" );
          ($(".chat_client_msg_list")).scrollTop( ($(".chat_client_msg_list")).prop('scrollHeight') );
        } else if( data.status == null ){
            showAlert('error', 'Ocurrió un error, inténtalo nuevamente');
        }
      })
      .fail(function(){
        console.log('error');
          showAlert('error', 'Ocurrió un error, intentalo nuevamente');
      });
    }
}

resize();