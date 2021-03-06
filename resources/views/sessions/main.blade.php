@extends('layouts.mainLayout')

  @section('title') Sesiones @endsection

  @section('extraheader')
    <link rel="stylesheet" href="{{ asset('css/sessions/style.css') }}">
  @endsection


  @section('content')
    <div class="container-fluid" id="mainContainer" style="background-image: url('{{ asset('img/web/saltum_back01.png') }}');">
      <div class="row">

        <div class="col-md-12 text-center" id="title1">
          Sesiones
        </div>
        <div class="col-md-12 text-center" id="title2">
          de coaching
        </div>


        <div class="col-md-12" id="block1-1">

          @IF( $sessionList['id'] != null )
            <div class="row">
              <div class="col-md-6 offset-md-3 text-center spaceMsg">
                Tu Próxima sesión es en:
              </div>
              <div class="col-md-6 offset-md-3 text-center" id="counterDiv">
                <div class="row">
                  <div class="col-sm-3 text-center counterDate">
                    <span id="counter_days">00</span>:
                  </div>
                  <div class="col-sm-3 text-center counterDate">
                    <span id="counter_hours">00</span>:
                  </div>
                  <div class="col-sm-3 text-center counterDate">
                    <span id="counter_minutes">00</span>:
                  </div>
                  <div class="col-sm-3 text-center counterDate">
                    <span id="coounter_seconds">00</span>
                  </div>

                  <div class="col-sm-3 text-center dateTag">
                    Días
                  </div>
                  <div class="col-sm-3 text-center dateTag">
                    Horas
                  </div>
                  <div class="col-sm-3 text-center dateTag">
                    Minutos
                  </div>
                  <div class="col-sm-3 text-center dateTag">
                    Segundos
                  </div>
                </div>
              </div>

              @IF( Session('role') != 4 )
                <div class="col-md-4 offset-md-4 text-center" id="msgDiv">
                  Esperando a que el coach inicie la sesión <br> <span><i class="far fa-clock fa-2x"></i></span>
                </div>
              @ENDIF

              <div class="col-md-6 offset-md-3 text-center button_container">
                <a href="{{ url('Sesiones/videollamada?sesion='.$sessionList['id'].'&type='.(( Session('role') == 4 )? '0' : '1')) }}">
                  <button type="button" name="button" id="start_call">Iniciar videollamada</button>
                </a>
              </div>

            </div>
          @ELSE

            @IF( Session('role') == 4 )
              <div class="row">
                <div class="col-md-6 text-left normalMsg">
                  No tienes sesiones pendientes.
                </div>
              </div>
            @ELSE
              @IF( count($tokenList) > 0  )
                <div class="row">
                  <div class="col-md-6 text-left normalMsg">
                    No tienes sesiones pendientes. <br><br>
                    Haz <a href="#">Click aquí</a> <span>para agendar una nueva.</span><br><br>
                    <a href="{{ url('Pago') }}"><img src="{{ asset('img/web/sesiones_solicitar.png') }}" id="renewPic"></a>
                  </div>
                </div>
              @ELSE
                <div class="row">
                  <div class="col-md-6 text-left normalMsg">
                    No tienes sesiones disponibles. <br><br>
                    Haz <a href="{{ url('Pago') }}">Click aquí</a> <span>para renovar sesiones.</span><br><br>
                    <a href="{{ url('Pago') }}"><img src="{{ asset('img/web/icono_renovar_sesiones.png') }}" id="renewPic"></a>
                  </div>
                </div>
              @ENDIF
            @ENDIF

          @ENDIF




        </div>
      </div>
    </div>
  @endsection


  @section('jqueryScripts')

      <script>
        $(document).ready(function() {
          //-----------------------------------
          //
          //         INITIAL CONDITIONS
          //
          //-----------------------------------
          $("#start_call").prop('disabled', true);
          @IF( $sessionList['id'] != null )
              conteoRegresivo( "{{ $sessionList['start_datetime'] }}" );
          @ENDIF

          //-----------------------------------
          //
          //         GENERAL FUNCTINOS
          //
          //-----------------------------------
          function conteoRegresivo( myDate ){
            var countDownDate = new Date(myDate).getTime();
            // var countDownDate = new Date().getTime();

            var myInterval = setInterval(function() {

                // Get todays date and time
                var now = new Date().getTime();

                // Find the distance between now an the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                $("#counter_days").html(days);
                $("#counter_hours").html(hours);
                $("#counter_minutes").html(minutes);
                $("#coounter_seconds").html(seconds)

                // If the count down is over, write some text
                if (distance < 0) {
                    $("#counter_days").html('00');
                    $("#counter_hours").html('00');
                    $("#counter_minutes").html('00');
                    $("#coounter_seconds").html('00');
                    $("#msgDiv").show();
                    @IF( Session('role') == 4 )
                      $("#start_call").prop('disabled', false);
                      $(".button_container").show();
                    @ENDIF
                    ajax_ask_status();
                    clearInterval(myInterval);
                }
            }, 1000);
          }


          //-----------------------------------
          //
          //         AJAX FUNCTIONS
          //
          //-----------------------------------
          //ask session status,    if coach has created the session, show link button
          function ajax_ask_status(){
            $.get( "{{ url('api/session-status/'.$sessionList['id']) }}", function( data ) {
                console.log('sesion status: '+ data);
                if(data == 9){
                  $("#msgDiv").hide();
                  $("#start_call").prop('disabled', false);
                  $(".button_container").show();
                } else {
                  setTimeout(function(){
                    ajax_ask_status();
                  }, 3000);
                }
            });
          }
        });
      </script>
  @endsection
