@extends('layouts.mainLayout')


  @section('title') TEEEEEEEEEST TEMPLATE - {{ Session('role_name') }} @endsection




  @include('partials._menu')



  @section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12" style="background-image:url('img/web/saltum_back01.png'); background-size: cover;">
          <br><br><br><br><br><br><br><br><br><br>
          <h2>Welcome to TEEEEEST Template</h2>
      </div>
    </div>

    @include('partials._chat')
  </div>
  @endsection
