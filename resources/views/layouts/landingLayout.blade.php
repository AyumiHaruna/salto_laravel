<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>SALTUM | @yield('title')</title>
    
      
    <!-- favicon -->
    <link rel="shortcut icon" href="img/info/icono_saltum.png" type="image/x-icon">
    <link rel="icon" href="img/info/icono_saltum.png" type="image/x-icon">
    <!-- web share -->
    <meta property="og:image" content="img/info/saltumlogocolor.png">
    <!-- normalize css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.0/normalize.min.css'">
    <!-- <link rel="stylesheet" href="{{ asset('css/normalize.min.css') }}"> -->

    <!-- jquery 3.3.1 -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- <script type="text/javascript" src="{{ asset('js/jquery-3.3.1.min.js') }}"></script> -->

    <!-- bootstrap 4.1.1 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <!-- <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <!-- <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script> -->

    <!-- Awesome Icons  v.5 -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- custo css -->
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/chat.css">

    @yield('extraheader')
  </head>
  <body>
    @yield('menu')
    @yield('content')
    @yield('footer')
  </body>
  @yield('jqueryScripts')
</html>
