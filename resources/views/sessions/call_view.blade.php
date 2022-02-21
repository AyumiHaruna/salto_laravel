@extends('layouts.mainLayout')

  @section('title') Sesiones @endsection

  @section('extraheader')
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <style media="screen">
        .footer{
          padding-top: 10%;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('css/sessions/style.css') }}">
    <link rel="stylesheet" href="{{ asset('TemplateData/style.css') }}">
    <script src="{{ asset('TemplateData/UnityProgress.js') }}"></script>
    <script src="{{ asset('js/webGL/UnityLoader.js') }}"></script>



    <script>
      // var gameInstance = UnityLoader.instantiate("gameContainer", "webGL/videochat.json");
      var gameInstance = UnityLoader.instantiate("gameContainer", "{{ asset('js/webGL/videochat.json') }}", {onProgress: UnityProgress});
    </script>

    <script type="text/javascript">
      $(document).ready(function() {
          var elementBottom = $(".navbar").outerHeight(true);
          $("#gameContainer").offset({ top : elementBottom });

      });
    </script>
  @endsection


  @section('content')
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 webgl-content" style="padding:0">
              <div id="gameContainer"></div>
          </div>
        </div>
      </div>

  @endsection
