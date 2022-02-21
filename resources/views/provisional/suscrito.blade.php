<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>SALTUM</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/provisional/landing.css') }}">

    <link rel="icon" type="image/png" href="{{ asset('img/provisional/favicon.png') }}" sizes="32x32" />

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  </head>

  <body>
    <div class="container-fluid">

      <div class="row header">
        <div class="col-md-6 logoContainer">
          <img src="{{ asset('../img/provisional/01_logo.png') }}" alt="LOGO SALTUM" id="imgLogo">
        </div>
        <div class="col-md-6 phoneContainer">
          Teléfono local: 5276-6415 <br>
            Lada: 01800-2148-000
        </div>
      </div>

      <div class="row successContainer">
        <div class="col-md-6 offset-md-3 text-center">
          <img src="{{ asset('../img/provisional/03_sobre.png') }}" alt="MAIL IMG" id="imgMail">
        </div>
        <div class="col-md-6 offset-md-3 text-center" id="successMsg">
          Te has suscrito a nuestro newsletter.
        </div>
      </div>
      <div class="row justify-content-md-center">
        <div class="col-md-4 text-center">
          <a href="{{ url('/provisional') }}"><button type="button" name="button" class="btn btn-block" id="aceptar">Aceptar</button></a>
        </div>
      </div>

      <!--<div class="row footer">
        <div class="col-md-4 offset-md-4 text-center">
          Síguenos en redes sociales: <br>
          <img src="{{ asset('img/provisional/fb_icon.png') }}" alt="FB" class="socialBtn">
          <img src="{{ asset('img/provisional/tw_icon.png') }}" alt="TW" class="socialBtn">
          <img src="{{ asset('img/provisional/ig_icon.png') }}" alt="IG" class="socialBtn">
        </div>
      </div>-->
    </div>


    <script type="text/javascript">
      $(document).ready(function() {
        var valFlag = [0,0];    //flag para validar datos

          //valida el nombre
          $("#nombre").on("blur", function() {
              var pattern = /^[a-zA-Zá-úÁ-Ú, ]{3,100}$/i;
              if( $(this).val() != '' ){
                if( pattern.test($(this).val()) ){
                  valFlag[0]=1;
                  $("#msg1, #msg3").hide();
                } else {
                  valFlag[0]=0;
                  $("#msg1").html('El nombre contiene caracteres inválidos');
                  $("#msg1").show();
                }
              } else {
                valFlag[0]=0;
              }

          });

          //valida el correo
          $("#correo").on("blur", function() {
            var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
            ((pattern.test($(this).val())) ? valFlag[1]=1 : valFlag[1]=0 );

            if( $(this).val() != '' ){
              if( pattern.test($(this).val()) ){
                valFlag[1]=1;
                $("#msg2, #msg3").hide();
              } else {
                valFlag[1]=0;
                $("#msg2").html('El correo tiene un formato inválido');
                $("#msg2").show();
              }
            } else {
              valFlag[1]=0;
            }

          });

          //revisa valFlag para hacer submit
          $("#suscribirse").on('click touchstart', function(){
            if( valFlag[0] == 1 && valFlag[1] == 1 ){
              $("#suscripcionForm").submit();
            } else {
              $("#msg3").html('Los datos aún contienen errores')
              $("#msg3").show();
            }
          });
      });
    </script>
  </body>
</html>
