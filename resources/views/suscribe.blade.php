@extends('layouts.mainLayout')


  @section('title')
      Suscríbete
  @endsection

  @section('extraheader')
    <link rel="stylesheet" href="{{ asset('css/info/style.css') }}">

    <!-- jquery-ui -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

    <!-- animaciones de entrada en textos -->
    <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('js/vendor/jquery.datetimepicker.min.css') }}" / >
    <script src="{{ asset('js/vendor/jquery.datetimepicker.full.js') }}"></script>
  @endsection


  @section('content')

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/es_ES/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
    fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <!-- Your customer chat code -->
    <div class="fb-customerchat"
    attribution=setup_tool
    page_id="181631609143753"
    theme_color="#25a9e0"
    logged_in_greeting="¡Hola! Gracias por escribirnos, ¿Cómo podemos ayudarte?"
    logged_out_greeting="¡Hola! Gracias por escribirnos, ¿Cómo podemos ayudarte?">
    </div>


    <div class="container-fluid">
      <div class="row" id="block1-p3">
        <div class="col-md-6 formContainer">
          <span class="title">Registrate</span>
          <form name="contact">
            <div class="row">
              <div class="col-md-12 feedback-none" id="feedback"> </div>
            </div>
            <input type="text" id="name" name="name" value="" class="form-control inputSuscribe" placeholder="Nombre" required>
            <input type="text" id="phone" name="phone" value="" class="form-control inputSuscribe" placeholder="Teléfono" required>
            <input type="text" id="email" name="email" value="" class="form-control inputSuscribe" placeholder="Correo electrónico" required>

            <div class="row">
              <div class="col-sm-4 text-right">
                  Horario de contacto:
              </div>
              <div class="col-sm-4">
                  <input type="text" name="schedule1" id="schedule1" class="form-control inputSuscribe time" placeholder="De">
              </div>
              <div class="col-sm-4">
                  <input type="text" name="schedule2" id="schedule2" class="form-control inputSuscribe time" placeholder="A">
              </div>
            </div>

            <textarea class="form-control inputSuscribe" name="comments" id="comments" rows="3" cols="80" placeholder="Comentarios"></textarea>
            <button type="button" name="button" class="btn hoverButton sendBtn">Enviar</button>
          </form>
        </div>

        <div class="col-md-6 rightContainer text-center">
          <h1>¡Comienza ahora!</h1>

          <p>
            - Cambia hábitos dañinos para tu salud <br>
            - Vive con propósito y sentido <br>
            - Reduce niveles de estrés <br>
            - Logra tus propósitos alimenticios <br>
          </p>

          Regístrate y un asesor se comunicará contigo.
        </div>
        <div class="col-md-6 offset-md-3 text-center bottomContainer">
          <h1>¡Da el primer SALTUM de Bienestar!</h1>

          Métodos de pago:<br><br>
          PayPal, Swap, Transferencia o depósito.
        </div>
      </div>
    </div>
  @endsection


  @section('jqueryScripts')
    <script type="text/javascript">
        $(document).ready(function(){
          //-----------------------------------------
          //          GLOBAL VARS
          //-----------------------------------------
          var valFlags = [0,0,0,0,0];       //flag for validation   [name, phone, email]
          var errors = [];

          //-----------------------------------------
          //          INITIAL CONDITIONS
          //-----------------------------------------
          //busca en que pixel Y se encuentra la pantalla
          testWindowScroll();

          //inicia animaciones de entrada
          AOS.init();

          $('.time').datetimepicker({
              datepicker:false,
              format: "H:i"
          });

          //-----------------------------------------
          //          GENERAL FUNCTIONS
          //-----------------------------------------
          function testWindowScroll(){
            if(window.scrollY > 50) {
                toggleMenuStyle("white-bg");
            } else {
                toggleMenuStyle("no-bg");
            }
          }

          function validateInput( tag ) {
            $("#"+tag).removeClass('is-valid');
            $("#"+tag).removeClass('is-invalid');
            switch (tag) {
              case 'name':
                    var pattern = /^[a-zA-Zá-úÁ-Ú, ]{3,100}$/i;
                    if( $("#"+tag).val() != '' ){     // != empty
                      if( pattern.test($("#"+tag).val()) ){     // test == true
                        valFlags[0]=1;
                        $("#"+tag).addClass('is-valid');
                      } else {            // test == false
                        valFlags[0]=0;
                        $("#"+tag).addClass('is-invalid');
                        errors.push('El nombre contiene caracteres inválidos');
                        $("#"+tag).focus();
                      }
                    } else {        // == empty
                      valFlags[0]=0;
                      $("#"+tag).addClass('is-invalid');
                      errors.push('Falta capturar el nombre');
                      $("#"+tag).focus();
                    }
              break;

              case 'phone':
                    var pattern = /^[\s\d\-]+$/;
                    if( $("#"+tag).val() != '' ){     // != empty
                      if( pattern.test($("#"+tag).val()) ){     // test == true
                        valFlags[1]=1;
                        $("#"+tag).addClass('is-valid');
                      } else {            // test == false
                        valFlags[1]=0;
                        $("#"+tag).addClass('is-invalid');
                        errors.push('El teléfono contiene caracteres inválidos');
                        $("#"+tag).focus();
                      }
                    } else {        // == empty
                      valFlags[1]=0;
                      $("#"+tag).addClass('is-invalid');
                      errors.push('Falta capturar el teléfono');
                      $("#"+tag).focus();
                    }
              break;

              case 'email':
                    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
                    if( $("#"+tag).val() != '' ){     // != empty
                      if( pattern.test($("#"+tag).val()) ){     // test == true
                        valFlags[2]=1;
                        $("#"+tag).addClass('is-valid');
                      } else {            // test == false
                        valFlags[2]=0;
                        $("#"+tag).addClass('is-invalid');
                        errors.push('El correo contiene un formato inválido');
                        $("#"+tag).focus();
                      }
                    } else {        // == empty
                      valFlags[2]=0;
                      $("#"+tag).addClass('is-invalid');
                      errors.push('Falta capturar el correo');
                      $("#"+tag).focus();
                    }
              break;

              case 'schedule1':
                if( $("#"+tag).val() != '' ){     // != empty
                    valFlags[3]=1;
                    $("#"+tag).addClass('is-valid');
                } else {
                  valFlags[3]=0;
                  $("#"+tag).addClass('is-invalid');
                  errors.push('Falta capturar la hora de inicio');
                }
              break;

              case 'schedule2':
              if( $("#"+tag).val() != '' ){     // != empty
                if ( ($("#schedule1").val()+':00') <= ($("#schedule2").val() + ':00') ) {
                  valFlags[4]=1;
                  $("#"+tag).addClass('is-valid');
                } else {
                  valFlags[4]=0;
                  $("#"+tag).addClass('is-invalid');
                  errors.push('La hora de inicio debe ser menor a la de término');
                }
              } else {
                valFlags[4]=0;
                $("#"+tag).addClass('is-invalid');
                errors.push('Falta capturar la hora de término');
              }
              break;

              default:  //
            }
          }

          //cambia el estilo del menú
          function toggleMenuStyle( type )
          {
            if( type == 'white-bg' )
            {
                $("#brandLogo").attr("src", "img/info/saltumlogocolor.png");
                $(".navbar").removeClass('no-bg');
                $(".navbar").addClass("navbar-light");
                $(".navbar").removeClass("navbar-dark");
            }
            else if( type == 'no-bg' )
            {
                $("#brandLogo").attr("src", "img/info/logo_saltum.png");
                $(".navbar").addClass('no-bg');
                $(".navbar").removeClass("navbar-light");
                $(".navbar").addClass("navbar-dark");
            }
          }

          //-----------------------------------------
          //          DOM FUNCTIONS
          //-----------------------------------------

          // //cambia el menu cuando se scrollea
          window.onscroll = function (e) {
            testWindowScroll();
          };

          //validate and submit form info
          $(".sendBtn").click(function(){
            errors = [];
            validateInput('name');
            validateInput('phone');
            validateInput('email');
            validateInput('schedule1');
            validateInput('schedule2');
            submitData();
          });

          //side function change style on dropdown
          $(".navbar-toggler").on('click', function(){
            if( $('#navbarResponsive').hasClass('show') ){        //if navBar dropdown is shown,   remove it (close dropdown)
              //when dropdown activates, alwways go to white style menu
              toggleMenuStyle( "white-bg" );
            } else {
              //test the scroll height to change menu style
              testWindowScroll();
            }
          });

          //-----------------------------------------
          //          AJAX FUNCTIONS
          //-----------------------------------------
          //test flags, if ok, send data by ajax
          function submitData(){
            if ( valFlags[0] == 1 && valFlags[1] == 1 && valFlags[2] == 1 && valFlags[3] == 1 && valFlags[4] == 1 ) {
              //submit form
              $("#feedback").removeClass('feedback');
              $("#feedback").addClass('feedback-none');

              $.ajax({
                data: { name: $("#name").val(),
                        phone: $("#phone").val(),
                        email: $("#email").val(),
                        schedule: $("#schedule1").val() + ' - ' + $("#schedule2").val(),
                        comment: $("#comments").val() },
                type: "POST",
                url: '{{ url('/suscribe') }}',
                beforeSend: function() {
                  $(".sendBtn").prop('disabled', true);
                  $(".sendBtn").html('<i class="fas fa-spinner fa-pulse fa-lg"></i>');
                }
              })
              .done(function(data){
                console.log(data);
                if (data == 1) {
                  //execute pixel facebook function
                  fbq('track', 'Lead', { value: 700, currency: 'mxn', });

                  //execute adWords function
                  gtag('event', 'conversion', {'send_to': 'AW-799579531/GnFPCI35yYQBEIu7ov0C'});

                  $(".sendBtn").prop('disabled', true);
                  $(".sendBtn").html('<i class="fas fa-check fa-lg"></i>');
                  //open a new tab with tank you message
                  if( navigator.userAgent.match(/Android/i)
                   || navigator.userAgent.match(/webOS/i)
                   || navigator.userAgent.match(/iPhone/i)
                   || navigator.userAgent.match(/iPad/i)
                   || navigator.userAgent.match(/iPod/i)
                   || navigator.userAgent.match(/BlackBerry/i)
                   || navigator.userAgent.match(/Windows Phone/i)
                   ){
                     window.open('{{ url("/tankyou") }}');
                    }
                   else {
                     window.open('{{ url("/tankyou") }}', 'width=600, height=400');
                   }
                } else {
                  $(".sendBtn").prop('disabled', false);
                  $(".sendBtn").html('Enviar');
                  showAlert('error', 'El correo ya ha sido registrado anteriormente');
                }
              })
              .fail(function(){
                  $(".sendBtn").prop('disabled', false);
                  $(".sendBtn").html('Enviar');
                  showAlert('error', 'Ocurrió un error, reintentalo nuevamente');
                  console.log('submitData("falló")');
              });
            } else {    //show erros message on feedback window
              var msg = '<ul>';
              for(var x=0; x<errors.length; x++)
              {
                msg += '<li>'+errors[x]+'</li>';
              }
              msg += '</ul>';
              $("#feedback").addClass('feedback');
              $("#feedback").removeClass('feedback-none');
              $("#feedback").html(msg);
            }
          }
        });
    </script>
  @endsection
