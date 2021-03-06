@extends('layouts.mainLayout')


  @section('title')
      Coaching de salud y bienestar
  @endsection

  @section('extraheader')
    <link rel="stylesheet" href="{{ asset('css/info/style.css') }}">

    <!-- jquery-ui -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>

    <!-- animaciones de entrada en textos -->
    <link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>

    <!-- slick -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/info/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/info/slick-theme.css') }}"/>
    <script src="{{ asset('js/slick.js') }}"></script>

    <meta name="description" content="Da el primer paso a una versión más saludable de ti mismo acompañado de nuestro equipo de coaching certificado en salud y bienestar.">
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
      <div class="parallax-window1 row justify-content-end" data-parallax="scroll" data-image-src="" id="block-bg1">
        <div class="col-md-6 text-center bigText" data-aos="fade-up" data-aos-duration="900">
          <div>
            La mejor jugada para tu salud.
          </div>
          <div>
            <a href="{{ url('/suscribe') }}"><button type="button" name="button" class="btn hoverButton">Comienza ahora.</button></a>
          </div>
        </div>
        <div class="col-md-12 text-center" id="block-bg1-2" data-aos="fade-up" data-aos-duration="700">
          Define, diseña y alcanza tus metas de salud y bienestar acompañado de nuestro
          equipo que te impulsará a dar el salto.
        </div>
      </div>

      <!-- carousel -->
      <div class="row">
        <div class="col-md-6 carouselHeader">
          ¿Algo de esto te suena?
        </div>
      </div>

      <div class="row carousel" style="margin-bottom: 0px !important;">
        <div class="col-md-12 carouselDiv" id="slide-01-01">
          <div class="row">
            <div class="col-md-6 carouselText">
              &nbsp;
            </div>
            <div class="col-md-6 text-left carouselText">
              “¡Ahora sí me voy a poner en forma!”
            </div>
          </div>
        </div>

        <div class="col-md-12 carouselDiv" id="slide-01-02">
          <div class="row">
            <div class="col-md-6 carouselText">
              &nbsp;
            </div>
            <div class="col-md-6 text-left carouselText">
              “¡Deseo manejar mis niveles de estrés!”
            </div>
          </div>
        </div>

        <div class="col-md-12 carouselDiv" id="slide-01-03">
          <div class="row">
            <div class="col-md-6 carouselText">
              &nbsp;
            </div>
            <div class="col-md-6 text-left carouselText">
              “¡Ya me quiero liberar del cigarro!”
            </div>
          </div>
        </div>

        <div class="col-md-12 carouselDiv" id="slide-01-04">
          <div class="row">
            <div class="col-md-6 carouselText">
              &nbsp;
            </div>
            <div class="col-md-6 text-left carouselText">
              “¡Anhelo descubrir mi propósito en la vida!”
            </div>
          </div>
        </div>

        <div class="col-md-12 carouselDiv" id="slide-01-05">
          <div class="row">
            <div class="col-md-6 carouselText">
              &nbsp;
            </div>
            <div class="col-md-6 text-left carouselText">
              “¡Esta vez sí voy a seguir mi dieta!”
            </div>
          </div>
        </div>

        <div class="col-md-12 carouselDiv" id="slide-01-06">
          <div class="row">
            <div class="col-md-6 carouselText">
              &nbsp;
            </div>
            <div class="col-md-6 text-left carouselText">
              “¡Quiero levantarme con energía por la mañana!”
            </div>
          </div>
        </div>
      </div>

      <!-- block2 -->
      <div class="parallax-window2 row justify-content-end" data-parallax="scroll" data-image-src="{{ url('img/info/cielo.png') }}" id="block2">
        <!-- <div class="row"  id="block2"> -->
        <div class="col-md-12 text-center" data-aos="fade-up" data-aos-duration="500">
          Cambiar vale la pena y se puede.
        </div>
      </div>

      <!-- block3 -->
      <div class="row" id="block3">
        <div class="col-md-12" id="sub1">
          <h1>Descubre cómo:</h1>
            Un coach es el guía que te acompañará en tu proceso de cambio de salud y bienestar. &nbsp; En este trayecto tú eliges los
            aspectos de vida que deseas mejorar, así mismo se te brindará motivación confianza, estrategias y habilidades para
            alcanzar el éxito.
        </div>
        <div class="col-md-5 iconsGroup">
          <div class="row align-items-center block-icon" data-aos="fade-up" data-aos-duration="500">
            <div class="col-3 text-right" >
              <img src="{{ asset('img/info/icon01.png') }}">
            </div>
            <div class="col-9">
              Sesión en vivo
            </div>
          </div>

          <div class="row align-items-center block-icon" data-aos="fade-up" data-aos-duration="500">
            <div class="col-3 text-right">
              <img src="{{ asset('img/info/icon02.png') }}" alt="">
            </div>
            <div class="col-9">
              90 minutos en la primer sesión <br>
              45 mins. en las sesiones siguientes
          </div>
        </div>

          <div class="row align-items-center block-icon" data-aos="fade-up" data-aos-duration="500">
            <div class="col-3 text-right">
              <img src="{{ asset('img/info/icon03.png') }}" alt="">
            </div>
            <div class="col-9">
              Sesión en línea o vía telefónica
            </div>
          </div>
        </div>
        <div class="col-md-12 text-center" data-aos="fade-up" data-aos-duration="500">
          <a href="{{ url('/suscribe') }}"><button type="button" name="button" class="btn hoverButton">Comienza ahora.</button></a>
        </div>
      </div>

      <!-- block4 -->
      <div class="row justify-content-center" id="block4">
        <div class="col-md-12" id="sub1">
          Coaches certificados
        </div>

        <div class="col-md-4 text-center coachContainer" data-aos="flip-left" data-aos-duration="500">
          <img src="{{ asset('img/info/anasofiabavoni.png') }}" alt="">
          <div class="name">
            Ana Sofia Bavoni
          </div>
        </div>

        <div class="col-md-4 text-center coachContainer" data-aos="flip-left" data-aos-duration="500">
          <img src="{{ asset('img/info/pilargarcia.png') }}" alt="">
          <div class="name">
            Pilar García
          </div>
        </div>

        <div class="col-md-4 text-center coachContainer" data-aos="flip-left" data-aos-duration="500">
          <img src="{{ asset('img/info/rodrigoescorza.png') }}" alt="">
          <div class="name">
            Rodrigo Escorza
          </div>
        </div>

        <div class="col-md-4 text-center coachContainer" data-aos="flip-left" data-aos-duration="500">
          <img src="{{ asset('img/info/paulinarodriguez.png') }}" alt="">
          <div class="name">
            Paulina Rodríguez
          </div>
        </div>

        <div class="col-md-4 text-center coachContainer" data-aos="flip-left" data-aos-duration="500">
          <img src="{{ asset('img/info/rossyaguilera.png') }}" alt="">
          <div class="name">
            Rossy Aguilera
          </div>
        </div>

        <div class="col-md-4 text-center coachContainer" data-aos="flip-left" data-aos-duration="500">
          <img src="{{ asset('img/info/paulinaflores.png') }}" alt="">
          <div class="name">
            Paulina Flores
          </div>
        </div>

        <div class="col-md-4 text-center coachContainer" data-aos="flip-left" data-aos-duration="500">
          <img src="{{ asset('img/info/usycastillo.png') }}" alt="">
          <div class="name">
            Usy Castillo
          </div>
        </div>

        <div class="col-md-4 text-center coachContainer" data-aos="flip-left" data-aos-duration="500">
          <img src="{{ asset('img/info/paulinaalanis.png') }}" alt="">
          <div class="name">
            Paulina Alanís
          </div>
        </div>
      </div>

      <!-- block5 -->
      <div class="row" id="block5">
        <div class="col-md-4 offset-md-4 text-center" data-aos="fade-up" data-aos-duration="500">
          Certificados por: <br>
          <img src="{{ asset('img/info/Salutis_Logo.png') }}" alt="" id="imgCertificado">
        </div>
      </div>

      <!-- block6 -->
      <div class="row" id="block6">
        <div class="col-md-12 text-center" data-aos="fade-up" data-aos-duration="500">
            <a href="{{ url('/suscribe') }}"><button type="button" name="button" class="btn hoverButton">Comienza ahora.</button></a>
        </div>
      </div>

      <!-- block7 -->
      <div class="row justify-content-center" id="block7">
        <div class="col-md-12">
          <h1>¿Qué beneficios obtendré?</h1>
        </div>
        <div class="col-sm-4 text-center iconContainer" data-aos="fade-up" data-aos-duration="500">
          <img src="{{ asset('img/info/icono_01.png') }}" alt="" class="icon-image">
          <div class="title">
            Serás consistente en tus actividades físicas.
          </div>
        </div>
        <div class="col-sm-4 text-center iconContainer" data-aos="fade-up" data-aos-duration="500">
          <img src="{{ asset('img/info/icono_02.png') }}" alt="" class="icon-image">
          <div class="title">
            Cambiarás hábitos dañinos para tu salud.
          </div>
        </div>
        <div class="col-sm-4 text-center iconContainer" data-aos="fade-up" data-aos-duration="500">
          <img src="{{ asset('img/info/icono_03.png') }}" alt="" class="icon-image">
          <div class="title">
            Vivirás con propósito y sentido.
          </div>
        </div>
        <div class="col-sm-4 text-center iconContainer" data-aos="fade-up" data-aos-duration="500">
          <img src="{{ asset('img/info/icono_04.png') }}" alt="" class="icon-image">
          <div class="title">
            Aumentarás tu energía.
          </div>
        </div>
        <div class="col-sm-4 text-center iconContainer" data-aos="fade-up" data-aos-duration="500">
          <img src="{{ asset('img/info/icono_05.png') }}" alt="" class="icon-image">
          <div class="title">
            Generarás emociones positivas para tener bienestar.
          </div>
        </div>
        <div class="col-sm-4 text-center iconContainer" data-aos="fade-up" data-aos-duration="500">
          <img src="{{ asset('img/info/icono_06.png') }}" alt="" class="icon-image">
          <div class="title">
            Lograrás tus propósitos alimenticios.
          </div>
        </div>
        <div class="col-sm-4 text-center iconContainer" data-aos="fade-up" data-aos-duration="500">
          <img src="{{ asset('img/info/icono_07.png') }}" alt="" class="icon-image">
          <div class="title">
            Reducirás tus niveles de estrés.
          </div>
        </div>
        <div class="col-md-12 text-center" id="bigText" data-aos="fade-up" data-aos-duration="500">
          ¡Da un SALTUM en tu salud!
        </div>
      </div>

      <!-- block 8 -->
      <div class="parallax-window3 row justify-content-end" data-parallax="scroll" data-image-src="" id="block8">
        <div class="col-md-7">
          <div class="upperText">"La vida saludable es un proceso, no un estado del
          ser. &nbsp; Se trata de una dirección, no un destino"</div>

          <div id="author" data-aos="fade-up" data-aos-duration="500">-Carl Rogers</div>

          <div class="btnContainer" data-aos="fade-up" data-aos-duration="500">
              <a href="{{ url('/suscribe') }}"> <button type="button" name="button" class="btn hoverButton">Quiero cambiar</button> </a>
          </div>
        </div>
      </div>

    </div>
  @endsection


  @section('jqueryScripts')

    <script type='text/javascript'>
      //change background image if with < 721
      if (window.innerWidth < 721) {
          $(".parallax-window1").attr("data-image-src", "{{ asset('img/info/foto01_low.jpg') }}");
          $(".parallax-window3").attr("data-image-src", "{{ url('img/info/foto03_low.jpg') }}");
      } else {
          $(".parallax-window1").attr("data-image-src", "{{ asset('img/info/foto01.png') }}");
          $(".parallax-window3").attr("data-image-src", "{{ url('img/info/foto03.png') }}");
      }
    </script>

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
        $('.parallax-window2').parallax();
        $('.parallax-window3').parallax();

        //inicia animaciones de entrada
         if( navigator.userAgent.match(/iPhone/i)
           || navigator.userAgent.match(/iPad/i)
           || navigator.userAgent.match(/iPod/i)
           || navigator.userAgent.match(/safari/i)
         ){
           $(".coachContainer").attr("data-aos", "");
           $(".coachContainer").attr("data-aos-duration", "0");
         }

        AOS.init();

        $('.carousel').slick({
          adaptiveHeight: true,
          mobileFirst: true,
          arrows: false,
          lazyLoad: 'ondemand',
          fade: true,
          dots: true,
          autoplay: true,
          autoplaySpeed: 3000,
          zindex: 1,
          pauseOnFocus: false,
          focusOnSelect: false,
          pauseOnHover: false,
          pauseOnDotsHover: false
        });
        //-----------------------------------------
        //          GENERAL FUNCTIONS
        //-----------------------------------------
        function testWindowScroll(){
          @IF(Session('user') == NULL)
            if(window.scrollY > 50) {
          @ELSE
            if(window.scrollY >= 0) {
          @ENDIF
              toggleMenuStyle("white-bg");
          } else {
              toggleMenuStyle("no-bg");
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
