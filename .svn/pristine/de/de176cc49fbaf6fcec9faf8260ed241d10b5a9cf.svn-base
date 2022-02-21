//-----------------------------------
//
//            STARTER FUNCTIONS
//
//-----------------------------------
// date time picker configurations
$('.dateTime').datetimepicker({
    format: "Y-m-d H:i:s"
});

$('.date').datetimepicker({
    timepicker:false,
    format: "Y-m-d"
});

$('.time').datetimepicker({
    datepicker:false,
    format: "H:i"
});
//

//-----------------------------------
//
//            DOM FUNCTIONS
//
//-----------------------------------
// invoke fill form function to create
$("#addSessionBtn").click(function(){
  configForm(0, 'create', user_role);
});

// invoke fill form function to config coach preferences
$("#coachConfigBtn").click(function(){
  configForm(0, 'config', user_role);
});

// close main form and transparency
$("#form_cancel_btn, .transparency, .closeFormBtn").click(function(){
  $('#mainForm')[0].reset();
  $(".form-container, .transparency").hide();
  $(".formAlert").hide();
  clearInterval(myInterval);
  $("#counterDiv").html("");
})

// hide alerts
$(".alertClose").click(function(){
  $(".formAlert").hide();
});

//submit the form
$("#form_submit_btn").click(function(){
  switch ( $("#hidden-type").val() ) {
    case 'client_schedule':
            if( confirm(" Se agendará una cita en la sesión seleccionada ") )
                $( "#mainForm" ).submit();
    break;

    case 'coach_acept':
            if( confirm(" ¿Desea confirmar la cita? ") )
                $( "#mainForm" ).submit();
    break;


    default:
          $( "#mainForm" ).submit();
  }
});

//hide session button
$("#form_hide_btn").click(function(){
    //ask if is ok to hidde
    if( confirm(" Se ocultará la sessión seleccionada ") ){
        $("#hidden-type").val('coach_hide');
        $("#mainForm").attr("action", change_stat);
        $( "#mainForm" ).submit();
    }
});

//hide session button
$("#form_cancelSession_btn").click(function(){
    //ask if is ok to hidde
    if( confirm(" ¿Desea cancelar la cita seleccionada? ") ){
        $("#hidden-type").val('cancel_session');
        $("#mainForm").attr("action", change_stat);
        $( "#mainForm" ).submit();
    }
});

// redirect to calendar whith selected coach results
$("#watchCoachBtn").click(function(){
  window.location.href = main_route+'?id='+$("#watchCoach").val()+'';
});

// before and next day button
$('body').on('click', 'button.fc-prev-button', function() {
  monthPosition --;
  testMonth();
  $(".loadingContainer").show();
  // printSquares();
});
$('body').on('click', 'button.fc-next-button', function() {
  monthPosition ++;
  testMonth();
  $(".loadingContainer").show();
  // printSquares();
});

$(".closeList").click(function(){
  $(".sessionList").html('');
  $(".sessionListContainer, .picSelected").hide();
});

$(".sessionList").on('click', '.task', function(){
  var thisId =  parseInt(($(this).attr('id')).substr(12));
  for (var i = 0; i < sessionList.length; i++) {
    if( sessionList[i]['id'] === thisId ){
      var thisStatus = sessionList[i]['status'];
      var thisData = sessionList[i];
      break;
    }
  }
  clickOnDate(thisId, thisStatus, thisData);
});


//-----------------------------------
//
//         GENERAL FUNCTINOS
//
//-----------------------------------
function clickOnDate( id, status, data){
  if(user_role == 4) {        //for coaches
    switch (status) {
      case 5:       //Disponible - coach can edit
        configForm(id, 'coach_edit', user_role);
        $("#hidden-session-id").val( id );
        $("#name").val( data.name );
        $("#description").val( data.description );
        $("#start_datetime").val( data.start_datetime );
      break;

      case 0:       //Agendado - scheduled for the client, coach can acept or cancel
        configForm(id, 'coach_acept', user_role);
        //console.log(data);
        $("#span_name").val(data['name']);
        $("#span_description").val(data['description']);
        $("#span_coach_name").val(data['coach_name']);
        $("#span_coachee_name").val(data['coachee_name']);
        $("#span_status").val(data['status']);
        $("#span_start_datetime").val( (data['start_datetime']).substr(0,10) + ' - ' + (data['start_datetime']).substr(10,6) + ' Hrs.' );
        $("#span_end_datetime").val( (data['end_datetime']).substr(0,10) + ' - ' + (data['end_datetime']).substr(10,6) + ' Hrs.' );
        $("#span_first_session").val(function(){
          return ((data['first_session'] == '1') ? 'SI' : 'NO');
        });
        $("#start_datetime").val( data.start_datetime );
        $("#end_datetime").val( data.end_datetime );
      break;

      case 6:       //Oculto - coach can un-hide sessions
        configForm(id, 'coach_unhide', user_role);
        $("#hidden-session-id").val( id );
        $("#span_name").val(data['name']);
        $("#span_description").val(data['description']);
        $("#span_coach_name").val(data['coach_name']);
        $("#span_coachee_name").val(data['coachee_name']);
        $("#span_status").val(data['status']);
        $("#span_start_datetime").val( (data['start_datetime']).substr(0,10) + ' - ' + (data['start_datetime']).substr(10,6) + ' Hrs.' );
        $("#span_end_datetime").val( (data['end_datetime']).substr(0,10) + ' - ' + (data['end_datetime']).substr(10,6) + ' Hrs.' );
        //console.log(data);
      break;
    }
  } else {          //for other  roles
    if ( user_role == 5 || user_role == 6 ) {   //client role
      switch (status) {
        case 5:             //the client chan schedule on this session
          configForm(id, 'client_schedule', user_role);
          $("#span_name").val(data['name']);
          $("#span_description").val(data['description']);
          $("#span_coach_name").val(data['coach_name']);
          $("#span_coachee_name").val(data['coachee_name']);
          $("#span_status").val(data['status']);
          $("#span_start_datetime").val( (data['start_datetime']).substr(0,10) + ' - ' + (data['start_datetime']).substr(10,6) + ' Hrs.' );
          $("#start_datetime").val(data['start_datetime']);
          //console.log(data);
        break;

        case 0:       //Agendado - scheduled for the client, client can look and cancel
          configForm(id, 'client_look_cancel', user_role);
          //console.log(data);
          $("#span_name").val(data['name']);
          $("#span_description").val(data['description']);
          $("#span_coach_name").val(data['coach_name']);
          $("#span_coachee_name").val(data['coachee_name']);
          $("#span_start_datetime").val( (data['start_datetime']).substr(0,10) + ' - ' + (data['start_datetime']).substr(10,6) + ' Hrs.' );
          $("#span_end_datetime").val( (data['end_datetime']).substr(0,10) + ' - ' + (data['end_datetime']).substr(10,6) + ' Hrs.' );
          $("#span_first_session").val(function(){
            return ((data['first_session'] == '1') ? 'SI' : 'NO');
          });
          $("#start_datetime").val( data.start_datetime );
          $("#end_datetime").val( data.end_datetime );
        break;
      }
    }
  }

  //for both type of users if status = Cancelado / Atendido / No Atendido
  if( status == 1 || status == 2 || status == 3 || status == 4 ){
    //console.log(data);
    configForm(id, 'show_info', user_role);
    $("#span_name").val(data['name']);
    $("#span_description").val(data['description']);
    $("#span_coach_name").val(data['coach_name']);
    $("#span_coachee_name").val(data['coachee_name']);
    $("#span_status").val(function(){
      switch (data['status']) {
        case 2:     return 'Cancelado';     break;
        case 4:     return 'Atendido';      break;
        case 5:     return 'No Atendido';     break;
      }
    });
    $("#span_start_datetime").val( (data['start_datetime']).substr(0,10) + ' - ' + (data['start_datetime']).substr(10,6) + ' Hrs.' );
    $("#span_end_datetime").val( (data['end_datetime']).substr(0,10) + ' - ' + (data['end_datetime']).substr(10,6) + ' Hrs.' );
    $("#span_first_session").val(function(){
      return ((data['first_session'] == '1') ? 'SI' : 'NO');
    });

    if (status == 1){
      conteoRegresivo( data['start_datetime'] );
    }
  }
}


//config form whit route, and get the nece3sary inputs
function configForm( id, type, role ){

    uid = id;
    //clear the form, and hide all elements

    $("#name_container").hide();
    $("#description_container").hide();
    $("#coach_id_container").hide();
    $("#start_datetime_container").hide();
    $("#end_datetime_container").hide();
    $("#start_date_container").hide();
    $("#end_date_container").hide();
    $("#start_time_container").hide();
    $("#end_time_container").hide();
    $("#w_day_container").hide();
    $(".counter_container").hide();

    $("#form_info_container").hide();
    $(".span_container_name").hide();
    $(".span_container_description").hide();
    $(".span_container_coach_name").hide();
    $(".span_container_coachee_name").hide();
    $(".span_container_status").hide();
    $(".span_container_start_datetime").hide();
    $(".span_container_end_datetime").hide();
    $(".span_container_first_session").hide();

    $("#form_hide_btn").hide();
    $("#form_submit_btn").hide();
    $("#form_cancel_btn").hide();
    $("#form_cancelSession_btn").hide();


    switch (type) {
              //Coach: create a new avalible session
        case 'create':
              //change attributes and html content
              $("#mainForm").attr("action", add_route);
              $("#form-title").html("Nueva Sesión");
              $("#form_submit_btn").html("Crear");

              //asign values
              $("#hidden-role").val(role);
              $("#hidden-type").val(type);
              $("#hidden-coachee_id").val(coachee_id);

              //show input fields
              $("#name_container").show();
              $("#description_container").show();
              $("#start_datetime_container").show();
              $("#form_submit_btn").show();
              $("#form_cancel_btn").show();
        break;

              //Coach: Create avalible sessions in the given range of dates
        case 'config':
              //change attributes and html content
              $("#mainForm").attr("action", config_route);
              $("#form-title").html("Configurar disponibilidad de sesiones");
              $("#form_submit_btn").html("Crear");

              //asign values
              $("#hidden-role").val(role);
              $("#hidden-type").val(type);
              $("#hidden-coachee_id").val(coachee_id);

              //show input fields
              $("#name_container").show();
              $("#description_container").show();
              $("#start_date_container").show();
              $("#end_date_container").show();
              $("#start_time_container").show();
              $("#end_time_container").show();
              $("#w_day_container").show();
              $("#form_submit_btn").show();
              $("#form_cancel_btn").show();
        break;

              //Coach: Update data from selected session
        case 'coach_edit':
              //change attributes and html content
              $("#mainForm").attr("action", edit_route);
              $("#form-title").html("Modificar datos de la Sesión");
              $("#form_submit_btn").html("Modificar");

              //asign values
              $("#hidden-role").val(role);
              $("#hidden-type").val(type);
              $("#hidden-coachee_id").val(coachee_id);
              $("#hidden-session-id").val(uid);

              //show input fields
              $("#name_container").show();
              $("#description_container").show();
              $("#start_datetime_container").show();
              $("#form_hide_btn").show();
              $("#form_submit_btn").show();
              $("#form_cancel_btn").show();
        break;

              //Client shedule session over an avalible session
        case 'client_schedule':
              //change attributes and html content
              $("#mainForm").attr("action", change_stat);
              $("#form-title").html("Agendar cita");
              $("#form_submit_btn").html("Agendar");

              //asign values
              $("#hidden-role").val(role);
              $("#hidden-type").val(type);
              $("#hidden-coachee_id").val(coachee_id);
              $("#hidden-session-id").val(uid);

              //show input fields
              $("#span_name").show();
              $("#span_description").show();

              $("#form_info_container").show();
              $(".span_container_name").show();
              $(".span_container_description").show();
              $(".span_container_coach_name").show();
              $(".span_container_start_datetime").show();

              $("#form_submit_btn").show();
              $("#form_cancel_btn").show();
        break;

              //Coach acept session scheduled by the client
        case 'coach_acept':
              //change attributes and html content
              $("#mainForm").attr("action", change_stat);
              $("#form-title").html("Aceptar cita");
              $("#form_submit_btn").html("Aceptar cita");

              //asign values
              $("#hidden-role").val(role);
              $("#hidden-type").val(type);
              $("#hidden-coachee_id").val(coachee_id);
              $("#hidden-session-id").val(uid);

              //show input fields
              $("#span_name").show();
              $("#span_description").show();

              $("#form_info_container").show();
              $(".span_container_name").show();
              $(".span_container_description").show();
              $(".span_container_coach_name").show();
              $(".span_container_coachee_name").show();
              $(".span_container_start_datetime").show();
              $(".span_container_end_datetime").show();
              $(".span_container_first_session").show();

              $("#form_submit_btn").show();
              $("#form_cancel_btn").show();
              $("#form_cancelSession_btn").show();
        break;

              //Coach un-hide a hidden session
        case 'coach_unhide':
            //change attributes and html content
            $("#mainForm").attr("action", change_stat);
            $("#form-title").html("Rehabilitar sesión");
            $("#form_submit_btn").html("Rehabilitar");

            //asign values
            $("#hidden-role").val(role);
            $("#hidden-type").val(type);
            $("#hidden-coachee_id").val(coachee_id);
            $("#hidden-session-id").val(uid);

            //show input fields
            $("#span_name").show();
            $("#span_description").show();

            $("#form_info_container").show();
            $(".span_container_name").show();
            $(".span_container_description").show();
            $(".span_container_coach_name").show();
            $(".span_container_start_datetime").show();
            $(".span_container_end_datetime").show();

            $("#form_submit_btn").show();
            $("#form_cancel_btn").show();
        break;

              //Client or coach can see all data of the selected session
        case 'show_info':
              //change attributes and html content
              $("#mainForm").attr("action", '');
              $("#form-title").html("Datos de la sesión");

              //show input fields
              $("#span_name").show();
              $("#span_description").show();

              $("#form_info_container").show();
              $(".span_container_name").show();
              $(".span_container_description").show();
              $(".span_container_coach_name").show();
              $(".span_container_coachee_name").show();
              $(".span_container_status").show();
              $(".span_container_start_datetime").show();
              $(".span_container_end_datetime").show();
              $(".span_container_first_session").show();

              $(".counter_container").show();
              $("#form_cancel_btn").show();
        break;

        case 'client_look_cancel':
                //change attributes and html content
                $("#mainForm").attr("action", '');
                $("#form-title").html("Datos de la sesión cancelada");

                //asign values
                $("#hidden-role").val(role);
                $("#hidden-type").val(type);
                $("#hidden-coachee_id").val(coachee_id);
                $("#hidden-session-id").val(uid);

                //show input fields
                $("#span_name").show();
                $("#span_description").show();

                $("#form_info_container").show();
                $(".span_container_name").show();
                $(".span_container_description").show();
                $(".span_container_coach_name").show();
                $(".span_container_coachee_name").show();
                $(".span_container_start_datetime").show();
                $(".span_container_end_datetime").show();
                $(".span_container_first_session").show();

                $("#form_cancel_btn").show();
                $("#form_cancelSession_btn").show();
        break;
    }

    $(".transparency").show();
    $(".form-container").show();
}



function conteoRegresivo( myDate ){
  var countDownDate = new Date(myDate).getTime();

  myInterval = setInterval(function() {

      // Get todays date and time
      var now = new Date().getTime();

      // Find the distance between now an the count down date
      var distance = countDownDate - now;

      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);

      // Output the result in an element with id="demo"
      $("#counterDiv").html(days + "días : " + hours + "hrs. : "
      + minutes + "min. : " + seconds + "seg. ");

      // If the count down is over, write some text
      if (distance < 0) {
          clearInterval(myInterval);
          $("#counterDiv").html(" La sesión expiró ");
      }
  }, 1000);
}



function testMonth(){
  //console.log('monthPosition: '+ monthPosition);
  if( monthPosition <= -2){
    $(".fc-prev-button").prop("disabled", true).hide();
  } else if( monthPosition >= 2 ) {
    $(".fc-next-button").prop("disabled", true).hide();
  } else if ( monthPosition > -2 && monthPosition < 2){
    $(".fc-next-button").prop("disabled", false).show();
    $(".fc-prev-button").prop("disabled", false).show();
  }
}



function printSquares( givenDate ){
  var start = new Date(moment(givenDate).format("YYYY-MM-01"));
  var end = new Date(moment(givenDate).format("YYYY-MM-") + moment().daysInMonth());
  // var start = new Date(previousMonth);
  // var end = new Date(lastMonth);

  for(start; start < end; start.setDate(start.getDate() + 1)) {    //goes day by day of interval
    var month = 1 + moment( start ).month();
    var day = moment( start ).date();
    var eventArray = new Array();

    for (var i = 0; i < sessionList.length; i++) {        //goes event by event and search for status
      sessionMonth = 1 + moment( sessionList[i]['start_datetime'] ).month();
      sessionDay = moment( sessionList[i]['start_datetime'] ).date();

      // console.log(month+' - '+sessionMonth);
      // console.log(day+' - '+sessionDay);

      if( month === sessionMonth && day === sessionDay ){
        eventArray.push(sessionList[i]['status']);
        // console.log('EQUAL');
        // console.log('');
      }
    }

    var squareStatus = 6; //hidden or no avalible, no need square
    var is6 = [0,1,2,3,4,5,6,8,9];
    var is2 = [0,1,2,3,4,5,8,9];
    var is5 = [0,1,3,4,5,8,9];
    var is34 = [0,1,3,4,8,9];
    var is0 = [0,1,8,9];
    var is89 = [1,8,9];
    var is1 = [1];

    if(eventArray.length > 0){
      for (var i = 0; i < eventArray.length; i++) {
        switch (squareStatus) {
          case 6:    if(jQuery.inArray(eventArray[i], is6)) { squareStatus = eventArray[i];   }     break;
          case 2:    if(jQuery.inArray(eventArray[i], is2)) { squareStatus = eventArray[i];   }     break;
          case 5:    if(jQuery.inArray(eventArray[i], is5)) { squareStatus = eventArray[i];   }     break;
          case 3:    if(jQuery.inArray(eventArray[i], is34)) { squareStatus = eventArray[i];   }     break;
          case 4:    if(jQuery.inArray(eventArray[i], is34)) { squareStatus = eventArray[i];   }     break;
          case 0:    if(jQuery.inArray(eventArray[i], is0)) { squareStatus = eventArray[i];   }     break;
          case 8:    if(jQuery.inArray(eventArray[i], is89)) { squareStatus = eventArray[i];   }     break;
          case 9:    if(jQuery.inArray(eventArray[i], is89)) { squareStatus = eventArray[i];   }     break;
          case 1:    if(jQuery.inArray(eventArray[i], is1)) { squareStatus = eventArray[i];   }     break;
          default:
        }
      }
    }

    var arrayStyles = ['NOagendado', 'NOconfirmado', 'NOcancelado', 'NOatendido', 'NOnoAtendido', 'NOdisponible', 'NOoculto', 'NOinProcess', 'NOinProcess']
    $(".fc-day-top[data-date='"+moment( start ).format('YYYY-MM-DD')+"']").addClass(arrayStyles[squareStatus]); //add class to style
  }
  setTimeout(function(){
    $(".loadingContainer").hide();
  }, 300);
}



function print_general_info(){
    var today = moment().format("YYYY-MM-DD 00:00");
    var today = new Date(today);
    var my_session_msg = '';

    // console.log(sessionList)
    for (var i = 0; i < sessionList.length; i++) {
      var sessionDate = new Date(sessionList[i]['start_datetime']);
      if( sessionDate >= today ){
        if( sessionList[i]['status'] == 0 || sessionList[i]['status'] == 1 || sessionList[i]['status'] == 2 ){
          var thisDia = (sessionList[i]['start_datetime']).substring(0,10);
          var thisHora = (sessionList[i]['start_datetime']).substring(11,16);
          switch (sessionList[i]['status']) {
            case 0:
                my_session_msg += (( user_role == 4 )? '<li>Sesion solicitada para confirmar el día: <br>'+thisDia+' - '+thisHora+'</li>' : '<li>Sesion en espera de confirmación el día: <br>'+thisDia+' - '+thisHora+'</li>' ) ;
            break;

            case 1:
                my_session_msg += '<li>Sesion programada el día: <br>'+thisDia+' - '+thisHora+'</li>' ;
            break;

            case 2:
                my_session_msg += (( user_role == 4 )? '<li>Sesion cancelada el día: <br>'+thisDia+' - '+thisHora+'</li>' : '<li>Sesion cancelada el día: <br>'+thisDia+' - '+thisHora+'</li>' );
            break;
          }
        }
      }
    }

    $("#msg_board").html('<ul>'+my_session_msg+'</ul>')
}
