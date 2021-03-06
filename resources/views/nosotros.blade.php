@extends('layouts.mainLayout')


  @section('title')
      Conoce los valores que conforman nuestra práctica
  @endsection

  @section('extraheader')
    <link rel="stylesheet" href="{{ asset('css/info/style.css') }}">

    <!-- jquery-ui -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

    <!-- animaciones de entrada en textos -->
    <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>

    <meta name="description" content="El cambio que deseas es posible, te invitamos a conocer más acerca de los 5 pilares que conforman nuestra práctica.">
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

      <!-- 1st background -->
      <div class="parallax-window1 row justify-content-end" data-parallax="scroll" data-image-src="" id="block1-p2-bg1">
        <div class="col-md-12 text-center bigText" data-aos="fade-left" data-aos-duration="900">
            ¿Sabías que?
        </div>
        <div class="col-md-12 text-center" id="sub1">
          <div class="row">
            <div class="col-sm-4 sub1Elm" data-aos="fade-right" data-aos-duration="300">
              <div class="percentage" id="rand1">8%</div>
              <div class="percentage-data">
                de la gente cumple con sus
                propósitos de año nuevo
              </div>
            </div>
            <div class="col-sm-4 sub1Elm" data-aos="fade-right" data-aos-duration="700">
              <div class="percentage" id="rand2">6.6</div>
              <div class="percentage-data">
                es la puntuación otorgada por los
                mexicanos al calificar su
                satisfacción general ante la vida.
              </div>
            </div>
            <div class="col-sm-4 sub1Elm" data-aos="fade-right" data-aos-duration="1100">
              <div class="percentage" id="rand3">12%</div>
              <div class="percentage-data">
                de las personas a nivel mundial
                se encuentran satisfechas con
                sus actividades laborales.
            </div>
            </div>
          </div>
        </div>
      </div>

      <!-- block2 -->
      <div class="row" id="block2-p2">
        <div class="col-md-12 text-center" id="sub1" data-aos="fade-up" data-aos-duration="500">
          Estamos convencidos de que el cambio es posible,
          por ello decidimos crear un equipo de coaches de
          salud y bienestar. Nos basamos en 5 pilares que
          forman nuestra práctica:
        </div>
      </div>

      <!-- block3 -->
      <div class="row justify-content-md-center" id="block3-p2">
        <div class="col-md-6 iconInfo" data-aos="fade-right" data-aos-duration="300">
          <div class="row">
            <div class="col-4 text-center">
              <img src="{{ asset('img/info/icono01.png') }}" class="iconPic">
            </div>
            <div class="col-8 textContainer">
              <p>
                <span class="title">Autocuidado</span><br>
                Ser modelos en la adopción de conductas que
                permitan mantener la salud, equilibrio, motivación,
                energía y crecimiento.
              </p>
            </div>
          </div>
        </div>

        <div class="col-md-6 iconInfo" data-aos="fade-right" data-aos-duration="300">
          <div class="row">
            <div class="col-4 text-center">
              <img src="{{ asset('img/info/icono02.png') }}" class="iconPic">
            </div>
            <div class="col-8 textContainer">
              <p>
                <span class="title">Autonomía</span><br>
                Reconocer que cada persona es
                experta en su propia vida y tiene el potencial para
                alcanzar sus metas.
              </p>
            </div>
          </div>
        </div>

        <div class="col-md-6 iconInfo" data-aos="fade-right" data-aos-duration="300">
          <div class="row">
            <div class="col-4 text-center">
              <img src="{{ asset('img/info/icono03.png') }}" class="iconPic">
            </div>
            <div class="col-8 textContainer">
              <p>
                <span class="title">Creatividad</span><br>
                Confiar en que cada persona tiene la capacidad
                de encontrar sus
                propias respuestas.
              </p>
            </div>
          </div>
        </div>

        <div class="col-md-6 iconInfo" data-aos="fade-right" data-aos-duration="300">
          <div class="row">
            <div class="col-4 text-center">
              <img src="{{ asset('img/info/icono04.png') }}" class="iconPic">
            </div>
            <div class="col-8 textContainer">
              <p>
                <span class="title">Empatía</span><br>
                Comprender y respetar los pensamientos, sentimientos,
                necesidades y deseos de las otras personas.
              </p>
            </div>
          </div>
        </div>

        <div class="col-md-6 iconInfo" data-aos="fade-right" data-aos-duration="300">
          <div class="row">
            <div class="col-4 text-center">
              <img src="{{ asset('img/info/icono05.png') }}" class="iconPic">
            </div>
            <div class="col-8 textContainer">
              <p>
                <span class="title">Positivismo</span><br>
                Sumar a la vida de las personas motivación, confianza,
                alegría y
                sentido.
              </p>
            </div>
          </div>
        </div>

        <div class="col-md-12 text-center">
          <a href="{{ url('/suscribe') }}">
            <button type="button" name="button" class="btn hoverButton">¡Comienza ahora!</button>
          </a>
        </div>
      </div>


    </div>
  @endsection


  @section('jqueryScripts')
    <script type='text/javascript'>
      //change background image if with < 721
      if (window.innerWidth < 721) {
          $(".parallax-window1").attr("data-image-src", "{{ asset('img/info/foto04_low.jpg') }}");
      } else {
          $(".parallax-window1").attr("data-image-src", "{{ asset('img/info/foto04.jpg') }}");
      }
    </script>

    <!-- parallax scroll -->
    <script type="text/javascript" src="{{ asset('js/parallax.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
          //-----------------------------------------
          //          GLOBAL VARS
          //-----------------------------------------

          //-----------------------------------------
          //          INITIAL CONDITIONS
          //-----------------------------------------
          //busca en que pixel Y se encuentra la pantalla
          testWindowScroll();
          $('.parallax-window1').parallax();

          //inicia animaciones de entrada
          AOS.init();

          // numbers animation
          if (window.innerWidth < 721){
              // do nothing
          }
          else {
             randomizeNumbers(1);
             randomizeNumbers(2);
             randomizeNumbers(3);
          }

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

          function randomizeNumbers(tag){
            numbers = ['0', '8', '6', '12'];
            appends = ['', '%', '.6', '%'];
            var output, started, duration, desired;

            // Constants
            duration = 1500;
            desired = numbers[tag];

            // Initial setup
            output = $('#rand'+tag);
            started = new Date().getTime();

            // Animate!
            animationTimer = setInterval(function() {
                // if the duration has been exceeded, stop animating
                // if (output.text().trim() === desired || new Date().getTime() - started > duration) {
                if (new Date().getTime() - started > duration) {
                    output.html(numbers[tag] + appends[tag])
                } else {
                    // console.log('animating numbers');
                    // Generate a random string to use for the next animation step
                    output.text(
                        ''+
                        Math.floor(Math.random() * 9)+
                        Math.floor(Math.random() * 9)
                    );
                }
            }, 10);
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

          // //cambia el menu cuando se scrollea
          window.onscroll = function (e) {
            testWindowScroll();
          };
        });
    </script>
  @endsection
