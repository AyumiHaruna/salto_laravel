@extends('layouts.mainLayout')


  @section('title') {{ $section->display_name }} @endsection

  @section('extraheader')
    <!-- <link rel='stylesheet' href='{{asset("css/calendar/fullcalendar.min.css")}}' /> -->

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css' />

    <!-- <link rel="stylesheet" href="{{env('PUBLIC_URL', 'http://localhost/public').'/css/material/material-design.min.css'}}"> -->
    <link rel="stylesheet" href="{{env('PUBLIC_URL', 'http://localhost/public').'/css/bootstrap/bootstrap-extend.min.css'}}">
    <link rel="stylesheet" href="{{ asset('css/calendar/calendar.css') }}">
  @endsection


  @section('content')
  <div class="container-fluid">
    <div class="row" id="main_container" style="background-image: url('{{ asset('img/web/saltum_back01.png') }}')">
      <div class="col-md-12">

        <div class="row transparency">
        </div>

        <img src="{{ asset('img/web/selected.png') }}" class="picSelected">

        <div class="row loadingContainer">
          <div class="col-md-12 text-center loading">
            <i class="fas fa-spinner fa-pulse fa-6x"></i>
          </div>
        </div>

        <!-- sessionList -->
        <div class="row">
          <div class="col-md-6 offset-md-3 sessionListContainer">
            <div class="row">
              <div class="col-md-12 sessionListHeader">
                Sesiones del: <span id="sessionListHeaderDate"></span>
                <button type="button" class="closeList"> <i class="fas fa-times fa-lg"></i> </button>
              </div>
            </div>
            <div class="row sessionList"> </div>
          </div>
        </div>


        <!-- main form div -->
        <div class="row">
          <div class="col-md-6 offset-md-3 form-container">
            <div class="row">
              <div class="col-md-12 form-header">
                <span id="form-title"></span>
                <button type="button" class="closeFormBtn"> <i class="fas fa-times fa-lg"></i> </button>
              </div>

              <div class="col-md-12 form-body">

                @IF (count($errors->mainForm) > 0)
                <div class="row">
                  <div class="col-md-12 formAlert">
                    <button type="button" class="close alertClose" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <ul>
                      @FOREACH ($errors->mainForm->all() as $error)
                          <li>{{ $error }}</li>
                      @ENDFOREACH
                    </ul>
                  </div>
                </div>
                @ENDIF

                <form id="mainForm" action="" method="post">
                  {{ csrf_field() }}



                  <div class="row" id="form_info_container">
                    <div class="col-md-12 span_container_name">
                      <label class="span_label">Nombre: </label> <input type="text" class="form-control" id="span_name" name="span_name" value="{{ old('span_name') }}" readOnly></input>
                    </div>
                    <div class="col-md-12 span_container_description">
                      <label class="span_label">Descripci??n: </label> <textarea type="text" class="form-control" id="span_description" name="span_description" readOnly>{{ old('span_description') }}</textarea>
                    </div>
                    <div class="col-md-12 span_container_coach_name">
                      <label class="span_label">Coach: </label> <input type="text" class="form-control" id="span_coach_name" name="span_coach_name" value="{{ old('span_coach_name') }}" readOnly></input>
                    </div>
                    <div class="col-md-12 span_container_coachee_name">
                      <label class="span_label">Coachee: </label> <input type="text" class="form-control" id="span_coachee_name" name="span_coachee_name" value="{{ old('span_coachee_name') }}" readOnly></input>
                    </div>
                    <div class="col-md-12 span_container_status">
                      <label class="span_label">Status: </label> <input type="text" class="form-control" id="span_status" name="span_status" value="{{ old('span_status') }}" readOnly></input>
                    </div>
                    <div class="col-md-12 span_container_start_datetime">
                      <label class="span_label">Fecha y hora de inicio: </label> <input type="text" class="form-control" id="span_start_datetime" name="span_start_datetime" value="{{ old('span_start_datetime') }}" readOnly></input>
                    </div>
                    <div class="col-md-12 span_container_end_datetime">
                      <label class="span_label">Fecha y hora de T??rmino: </label> <input type="text" class="form-control" id="span_end_datetime" name="span_end_datetime" value="{{ old('span_end_datetime') }}" readOnly></input>
                    </div>
                    <div class="col-md-12 span_container_first_session">
                      <label class="span_label">Primera Sesi??n: </label> <input type="text" class="form-control" id="span_first_session" name="span_first_session" value="{{ old('span_first_session') }}" readOnly></input>
                    </div>
                  </div>


                  <input type="hidden" name="hidden-role" id="hidden-role" value="{{Session('role')}}">
                  <input type="hidden" name="hidden-type" id="hidden-type" value="">
                  <input type="hidden" name="hidden-coachee_id" id="hidden-coachee_id" value="">
                  <input type="hidden" name="hidden-session-id" id="hidden-session-id" value="">


                  <div class="row">
                    <div class="col-md-12" id="name_container">
                      <label for="name">Nombre:</label>
                      <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" />
                    </div>

                    <div class="col-md-12" id="description_container">
                      <label for="name">Descripci??n:</label>
                      <textarea class="form-control" id="description" name="description"/> {{ old('description') }} </textarea>
                    </div>

                    <div class="col-md-12" id="coach_id_container">
                      <label for="coach_id">Coach:</label>
                      <select class="form-control" id="coach_id" name="coach_id">
                        @IF(Session('role') == '4')
                            <option value="{{Session('user')->id}}">{{ Session('user')->name }} {{ Session('user')->last_name }}</option>
                        @ELSE
                          @IF(isset($coaches))
                              @FOREACH($coaches as $index => $coach)
                                  <option value="{{ $coach->id }}" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;"  @if(old('coach_id') == $coach->id) selected @endif >{{ $coach->name.' '.$coach->last_name }}</option>
                              @ENDFOREACH
                          @ENDIF
                        @ENDIF

                      </select>
                    </div>

                    <div class="col-md-6" id="start_datetime_container">
                      <label for="start_datetime">Fecha y hora de la sesi??n:</label>
                      <input type="text" class="form-control dateTime" id="start_datetime" name="start_datetime" value="{{ old('start_datetime') }}" autocomplete="off" />
                    </div>

                    <div class="col-md-6" id="end_datetime_container">
                      <label for="start_date">Fecha y hora de t??rmino:</label>
                      <input type="text" class="form-control datetime" id="end_datetime" name="end_datetime" value="{{ old('end_datetime') }}" autocomplete="off" />
                    </div>

                    <div class="col-md-6" id="start_date_container">
                      <label for="start_date">Fecha de inicio:</label>
                      <input type="text" class="form-control date" id="start_date" name="start_date" value="{{ old('start_date') }}" autocomplete="off" />
                    </div>

                    <div class="col-md-6" id="end_date_container">
                      <label for="end_date">Fecha de t??rmino:</label>
                      <input type="text" class="form-control date" id="end_date" name="end_date" value="{{ old('end_date') }}" autocomplete="off" />
                    </div>

                    <div class="col-md-6" id="start_time_container">
                      <label for="start_time">De:</label>
                      <input type="text" class="form-control time" id="start_time" name="start_time" value="{{ old('start_time') }}" autocomplete="off" />
                    </div>

                    <div class="col-md-6" id="end_time_container">
                      <label for="end_time">a:</label>
                      <input type="text" class="form-control time" id="end_time" name="end_time" value="{{ old('end_time') }}" autocomplete="off" />
                    </div>

                    <div class="col-md-12 text-center" id="w_day_container">
                      <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" id="w_day0" value="0" name="w_days[]" {{ (is_array(old('w_days')) && in_array(0, old('w_days')))? 'checked' : ''}} > Dom
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" id="w_day1" value="1" name="w_days[]" {{ (is_array(old('w_days')) && in_array(1, old('w_days')))? 'checked' : ''}}> Lun
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" id="w_day2" value="2" name="w_days[]" {{ (is_array(old('w_days')) && in_array(2, old('w_days')))? 'checked' : ''}}> Mar
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" id="w_day3" value="3" name="w_days[]" {{ (is_array(old('w_days')) && in_array(3, old('w_days')))? 'checked' : ''}}> Mie
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" id="w_day4" value="4" name="w_days[]" {{ (is_array(old('w_days')) && in_array(4, old('w_days')))? 'checked' : ''}}> Jue
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" id="w_day5" value="5" name="w_days[]" {{ (is_array(old('w_days')) && in_array(5, old('w_days')))? 'checked' : ''}}> Vie
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox" id="w_day6" value="6" name="w_days[]" {{ (is_array(old('w_days')) && in_array(6, old('w_days')))? 'checked' : ''}}> Sab
                        </label>
                      </div>
                    </div>

                    <div class="col-md-12 counter_container">
                      <label> La sesi??n inicia en: </label> &nbsp; &nbsp;
                      <span id="counterDiv"></span>
                    </div>

                  </div>
                </form>
              </div>

              <div class="col-md-12 form-footer">
                <button type="button" name="button" class="btn btn-outline-success" id="form_submit_btn">Aceptar</button>
                <button type="button" name="button" class="btn btn-outline-dark" id="form_hide_btn">Ocultar Fecha</button>
                <button type="button" name="button" class="btn btn-outline-danger" id="form_cancelSession_btn">Cancelar cita</button>
                <button type="button" name="button" class="btn btn-outline-secondary" id="form_cancel_btn">Cancelar</button>
              </div>
            </div>
          </div>
        </div>


        <!-- calendar div -->
        <div class="row">
            <div class="col-md-12 text-center" id="titleContainer">
              {{ $section->display_name }}
            </div>

            <div class="col-md-3" id="session_count_container">
              <div class="row" id="session_count">
                <div class="col-md-12">
                  <span>10</span> &nbsp; sesiones pagadas.
                </div>
                <div class="col-md-12">
                  <span>6</span> &nbsp; sesiones disponibles.
                </div>
                <div class="col-md-12">
                  <span>4</span> &nbsp; sesiones pendientes.
                </div>
              </div>

              @IF(Session('role') != '4')
                <div class="row" id="session_search">
                  <div class="col-md-12">
                    Mostrar sesiones del coach:<br>
                    <select class="form-control" name="watchCoach" id="watchCoach">
                      <option value="0">Todos</option>
                      @FOREACH($coaches as $coach)
                        <option value="{{ $coach->id }}"
                          @IF( ISSET($_GET['id']) )
                            {{ (($_GET['id'] == $coach->id )? 'SELECTED' : '') }}
                          @ENDIF
                        >
                            {{ $coach->name }} {{ $coach->last_name }}
                        </option>
                      @ENDFOREACH
                    </select>
                    <button type="button" class="btn btn-block" name="watchCoachBtn" id="watchCoachBtn"> <i class="fas fa-search"></i> </button>
                  </div>
                </div>
              @ENDIF
            </div>

            <div class="col-md-6" id="calendar_main_content">
              <div id='calendar'></div>
            </div>

            <div class="col-md-3" id="session_info_container">
              <div class="row" id="session_info">
                <div class="col-md-12">
                  <div class="square-info" id="sqAgendado">&nbsp;</div>
                  <div class="square-text">
                    En espera de aprovaci??n
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="square-info" id="sqConfirmado">&nbsp;</div>
                  <div class="square-text">
                    Sesi??nes pendientes
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="square-info" id="sqDisponible">&nbsp;</div>
                  <div class="square-text">
                    Sesi??nes disponibles
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="square-info" id="sqCancelado">&nbsp;</div>
                  <div class="square-text">
                    Sesi??nes canceladas
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="square-info" id="sqAtendido">&nbsp;</div>
                  <div class="square-text">
                    Sesi??nes atendidas
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="square-info" id="sqNoAtendido">&nbsp;</div>
                  <div class="square-text">
                    Sesi??nes no atendidas
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="square-info" id="sqProcess">&nbsp;</div>
                  <div class="square-text">
                    Sesi??nes en proceso
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12" id="msg_board"> </div>
              </div>
            </div>

        </div>


        <!-- action buttons div -->
        <div class="row actionBtnContainer">
          <div class="col-md-12">
            @IF(Session('role') == '4')
              <button type="button" name="button" id="addSessionBtn" class="btn  btn-light circleBtn"> <i class="fas fa-plus fa-lg"></i> </button>
              <br>
              <button type="button" name="button" id="coachConfigBtn" class="btn  btn-light circleBtn"> <i class="far fa-calendar-alt fa-lg"></i> </button>
            @ENDIF

          </div>
        </div>

      </div>
    </div>
  </div>

  @endsection




@section('jqueryScripts')

    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script> -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.js'></script>
    <script src="{{ asset('js/lang/fullcalendar_es.js') }}"></script>
    <script src="{{ asset('js/jquery.multi-select.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('js/vendor/jquery.datetimepicker.min.css') }}" / >
    <script src="{{ asset('js/vendor/jquery.datetimepicker.full.js') }}"></script>
    <script src="{{ asset('js/calendar.js') }}"></script>

    <script>
      var user_role = {{ Session('role') }};
      var coachee_id = {{ ((Session('role') == 4) ? 0 : Session('user')->id ) }};

      var add_route = "{{route('Calendario.store')}}";
      var config_route = "{{ route('Calendario.config') }}";
      var edit_route = "{{ route('Calendario.edit') }}";
      var change_stat = "{{ route('Calendario.editStatus') }}";
      var main_route = "{{ url('/Calendario') }}";

      var token = '{{ csrf_token() }}';

      // var previousMonth = moment('{{ $previousMonth }}', 'YYYY/MM/DD').format();
      // var lastMonth = moment('{{ $lastMonth }}', 'YYYY/MM/DD').format();

      var myInterval;

      var monthPosition = 0;

      var sessionList = ('{{ $sessions }}').replace(/&quot;/g,'"');
      sessionList = JSON.parse(sessionList);

      $(document).ready(function() {
        $('#calendar').fullCalendar({
          lang: 'es',
          defaultView: 'month',
          timezone: 'America/Mexico_City',
          showNonCurrentDates: false,

          //on date click
          dayClick: function(date) {

            currentDate = new Date(date['_d']);
            currentDate.setDate(currentDate.getDate() + 1);

            var startYear = moment(currentDate).year();
            var startMonth = 1 + moment(currentDate).month();
            var startDay = moment(currentDate).date();
            var sessionsOfDay = new Array();

            // get sessions of the day
            for (var i = 0; i < sessionList.length; i++) {
              currentMonth = 1 + moment( sessionList[i]['start_datetime'], 'YYYY/MM/DD' ).month();
              currentDay = moment( sessionList[i]['start_datetime'], 'YYYY/MM/DD' ).date();
              if( currentMonth === startMonth && currentDay === startDay){
                sessionsOfDay.push( sessionList[i] );
              }
            }

            // if there's sessions of the day, print them on table
            var sessionListText = '';
            if( sessionsOfDay.length > 0 ){
              $("#sessionListHeaderDate").html( (moment(currentDate).year())+'/'+(1 + moment(currentDate).month())+'/'+(moment(currentDate).date()) );
              for (var i = 0; i < sessionsOfDay.length; i++) {
                var elmStatusText = '';
                var elmClass = '';
                switch (sessionsOfDay[i]['status']) {
                  case 0:  elmClass = 'agendado';   elmStatusText = 'Pendiente de confirmar';      break;
                  case 1:  elmClass = 'confirmado';   elmStatusText = 'Confirmado';      break;
                  case 2:  elmClass = 'cancelado';   elmStatusText = 'Cancelado';      break;
                  case 3:  elmClass = 'atendido';   elmStatusText = 'Atendido';      break;
                  case 4:  elmClass = 'noAtendido';   elmStatusText = 'No atendido';      break;
                  case 5:  elmClass = 'disponible';   elmStatusText = 'Disponible';    break;
                  case 6:  elmClass = '{{ ((Session('role') == 4)? 'disabled' : 'oculto') }}';   elmStatusText = 'Oculto';      break;
                  case 8:  elmClass = 'inProcess';   elmStatusText = 'En proceso';      break;
                  case 9:  elmClass = 'inProcess';   elmStatusText = 'En proceso';      break;
                }


                sessionListText += '<div class="col-sm-6 taskContainer">';
                sessionListText +=  '<div class="task '+elmClass+'" id="sessionTask-'+sessionsOfDay[i]['id']+'">';
                sessionListText +=   '<span class="sessionListLabel">Coach:</span> &nbsp; <span class="sessionListSpan">'+sessionsOfDay[i]['coach_name']+' '+sessionsOfDay[i]['coach_last_name']+'</span><br>';
                sessionListText +=   '<span class="sessionListLabel">Categor??a:</span> &nbsp; <span class="sessionListSpan">'+sessionsOfDay[i]['name']+'</span><br>';
                sessionListText +=   '<span class="sessionListLabel">Status:</span> &nbsp; <span class="sessionListSpan">'+elmStatusText+'</span><br>';
                sessionListText +=   '<span class="sessionListLabel">Fecha de la sesi??n:</span> &nbsp; <span class="sessionListSpan">'+(sessionsOfDay[i]['start_datetime']).substring(0, 10)+'</span><br>';
                sessionListText +=   '<span class="sessionListLabel">Hora de inicio:</span> &nbsp; <span class="sessionListSpan">'+(sessionsOfDay[i]['start_datetime']).substring(11, 16)+'</span><br>';
                sessionListText +=  '</div>';
                sessionListText += '</div>';
              }


              $(".sessionList").html(sessionListText);
              var soloYear = (moment(currentDate).format('YYYY/MM/DD')).substr(0,4);
              var soloMonth = (moment(currentDate).format('YYYY/MM/DD')).substr(5,2);
              var soloDay = (moment(currentDate).format('YYYY/MM/DD')).substr(8,2);

              var elementTop = $(".fc-day-top[data-date='"+soloYear+"-"+soloMonth+"-"+soloDay+"'").offset();
              var elementBottom = $(".fc-day-top[data-date='"+soloYear+"-"+soloMonth+"-"+soloDay+"'").outerHeight(true);
              var elementRight = $(".fc-day-top[data-date='"+soloYear+"-"+soloMonth+"-"+soloDay+"'").outerWidth(true);

              $(".sessionListContainer").offset({ top : (elementTop.top+elementBottom) });
              $(".sessionListContainer, .picSelected").show();
              $(".picSelected").offset({ top : (elementTop.top+(elementBottom-9)), left : (elementTop.left+((elementRight/2)-5)) });
              $(".sessionListContainer").offset({ top : (elementTop.top+elementBottom) });
            }
          },        //end dayClick function

          viewRender: function (view, element) {
            var b = $('#calendar').fullCalendar('getDate');
            // alert(moment(b).format("YYYY-MM-01"));
            printSquares(moment(b).format("YYYY-MM-01"));
          },
        });

        print_general_info();

        @IF (count($errors->mainForm) > 0)
          configForm({{ Session::get('session_id') }}, "{{ Session::get('type') }}", user_role,);
        @ENDIF

        @IF ( Session::get('status') != null )
          showAlert("ok", "{{Session::get('status')}}")
        @ENDIF

        $(".fc-left h2").click(function(){
          $(".fc-today-button").trigger('click');
          monthPosition = 0;
          testMonth();
          $(".loadingContainer").show();
          // printSquares();
        });

      });
    </script>
@endsection
