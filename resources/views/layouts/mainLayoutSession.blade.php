<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>@yield('title') | SALTUM</title>
    @include('partials._header')
    @yield('extraheader')
  </head>
  <body>
    @include('partials._menu')
    @include('partials._title_admin')
    @include('partials._alert')
    @include('partials._avisoPrivacidad')
    @yield('content')
  </body>
  @yield('jqueryScripts')
</html>
