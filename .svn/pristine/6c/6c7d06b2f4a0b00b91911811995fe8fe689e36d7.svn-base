@extends('layouts.mainLayout')


  @section('title')
      Gracias
  @endsection

  @section('extraheader')
    <link rel="stylesheet" href="{{ asset('css/info/style.css') }}">

    <!-- jquery-ui -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
  @endsection

  @section('content')
    <div class="container-fluid">
      <div class="row" id="block1-p4">
        <div class="col-md-12 text-center mainDiv">
            <h1>Gracias por inscribirte</h1>
            <p>Dentro de poco uno de nuestros asesores se comunicará contigo.</p>
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

      //-----------------------------------------
      //          INITIAL CONDITIONS
      //-----------------------------------------
      //busca en que pixel Y se encuentra la pantalla
      testWindowScroll();


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

      //on hover transparenta texto
      $( ".nav-link" ).hover(
        function() {
          $(this).fadeTo( "fast" , 0.7);
        }, function() {
          $(this).fadeTo( "fast" , 1);
        }
      );


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
    });
    </script>
  @endsection
