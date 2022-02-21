@extends('layouts.mainLayout')


  @section('title') Dashboard - {{ Session('role_name') }} @endsection




  @include('partials._menu')



  @section('content')
    <div class="" style="background-image:url('img/web/saltum_back01.png'); background-size: cover; height: 90vh;">
      <br><br><br><br><br><br><br><br><br><br>
            <h2>Welcome to SALTUM Dashboard</h2>

            Session-role:  {{ Session('role') }}

            <br><br>

            alerts: {{ $alert }}

            <br><br>

    </div>
  @endsection
