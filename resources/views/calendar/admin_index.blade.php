@extends('layouts.mainLayoutSession')


  @section('title') {{ $section->display_name }} - Administrador @endsection

  @section('extraheader')
    <!-- <link rel='stylesheet' href='{{asset("css/calendar/fullcalendar.min.css")}}' /> -->

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.min.css' />

    <!-- <link rel="stylesheet" href="{{env('PUBLIC_URL', 'http://localhost/public').'/css/material/material-design.min.css'}}"> -->
    <link rel="stylesheet" href="{{env('PUBLIC_URL', 'http://localhost/public').'/css/bootstrap/bootstrap-extend.min.css'}}">
    <link rel="stylesheet" href="{{ asset('css/calendar/admin_calendar.css') }}">
  @endsection


  @section('content')
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-3 admin_data_info_container">
            <div class="row admin_data_info">
              <div class="col-sm-12 ">
                <div class="row admin_data_block">
                  <div class="col-3 text-center admin_data_square square_green">  {{ $adminData['dadas'] }}  </div>
                  <div class="col-9 square_info_black">  SESIONES DADAS   </div>
                </div>
                <div class="row admin_data_block">
                  <div class="col-3 text-center admin_data_square square_yellow">  {{ $adminData['proximas'] }}  </div>
                  <div class="col-9 square_info_black">  SESIONES PRÓXIMAS   </div>
                </div>
                <div class="row admin_data_block">
                  <div class="col-3 text-center admin_data_square square_pink">  {{ $adminData['canceladas'] }}  </div>
                  <div class="col-9 square_info_black">  SESIONES CANCELADAS   </div>
                </div>
              </div>
            </div>

            <div class="row admin_data_info">
              <div class="col-sm-12">
                <div class="row admin_data_block">
                  <div class="col-3 text-center admin_data_square square_gray">  {{ number_format($adminData['promDiarias'], 2, '.', ',')}}  </div>
                  <div class="col-9 square_info_gray">  SESIONES DIARIAS   </div>
                </div>
                <div class="row admin_data_block">
                  <div class="col-3 text-center admin_data_square square_gray">  {{ number_format($adminData['promSemana'], 2, '.', ',') }}  </div>
                  <div class="col-9 square_info_gray">  SESIONES SEMANALES   </div>
                </div>
                <div class="row admin_data_block">
                  <div class="col-3 text-center admin_data_square square_gray">  {{ number_format($adminData['promMes'], 2, '.', ',') }}  </div>
                  <div class="col-9 square_info_gray">  SESIONES MENSUALES   </div>
                </div>
                <div class="row admin_data_block">
                  <div class="col-3 text-center admin_data_square square_gray">  {{ number_format($adminData['promAnual'], 2, '.', ',') }}  </div>
                  <div class="col-9 square_info_gray">  SESIONES ANUALES   </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-sm-9">
            <div id="calendar">

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
    <!-- <script src="{{ asset('js/calendar.js') }}"></script> -->

    <script>
      $(document).ready(function() {
        $('#calendar').fullCalendar({
            defaultView: 'agendaWeek',
            slotLabelFormat:"h:mma",
            lang: 'es',
            timezone: 'America/Mexico_City',
            firstHour: 12

            events: [
              @FOREACH($sessions as $session)
              {
                id: '{{ $session->id }}',
                status: '{{$session->status}}',
                title : '{{ $session->name }}',
                description : '{{ $session->description }}',
                coach_name : '{{ $session->coach_name }} {{ $session->coach_last_name }}',
                coachee_name : '{{ $session->coachee_name }} {{ $session->coachee_last_name }}',
                start_datetime : '{{ $session->start_datetime }}',
                end_datetime : '{{ $session->end_datetime }}',
                start : '{{ $session->start_datetime }}',
                end : '{{ $session->end_datetime }}',
                color: <?php switch($session->status){
                                case 0: // Agendado
                                    echo '"#3a87ad"';
                                    break;
                                case 1: // Confirmado
                                    echo '"#247732"';
                                    break;
                                case 2: // Cancelado
                                    echo '"#b11920"';
                                    break;
                                case 3: // Atendido
                                    echo '"#55ade0"';
                                    break;
                                case 4: // No Atendido
                                    echo '"#ab7017"';
                                    break;
                                case 5: // Dsiponible (Coach)
                                    echo '"#b3b3b3"';
                                    break;
                                case 6: // Dsiponible (Coach)
                                    echo '"#595959"';
                                    break;
                                default: echo '"#fff"';

                } ?>,
              },
              @ENDFOREACH
            ],

            eventClick: function(calEvent, jsEvent, view){
              // clickOnDate(calEvent.id, calEvent.status, jsEvent);
              console.log(calEvent);
              console.log(jsEvent);
            },
        });
      });
    </script>
@endsection
