<!-- Navigation -->
  <nav class="navbar navbar-expand-md navbar-light fixed-top navVoid" id="mainNav">
    <div class="container-fluid">
      <a class="navbar-brand js-scroll-trigger" href="{{ url('/') }}"> <img src="{{ asset('img/info/saltumlogocolor.png') }}" alt="" id="brandLogo">  </a>
      <button class="navbar-toggler navbar-toggler-right custom-toggler-white" type="button">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          @if(Session('role') === NULL)
            {{Session('role')}}
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger navBtn {{ Request::is('/') ? 'navActive' : '' }}" href="{{ url('/') }}" >Inicio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger navBtn {{ Request::is('about') ? 'navActive' : '' }}" href="{{ url('/about') }}" >Nosotros</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger navBtn {{ Request::is('suscribe') ? 'navActive' : '' }}" href="{{ url('/suscribe') }}" >Inscripción</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger navBtn {{ Request::is('Blog/*') ? 'navActive' : '' }}" href="{{ url('/Blog') }}" >Blog</a>
            </li>
          @else
            @foreach(Session('menu_info') as $group_item)
              @if(sizeOf($group_item->permissions) > 1)
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle <?php
                    if(isset($section) && ($section->group == $group_item->id)){
                      echo 'navActive';
                   }?>" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  {{ $group_item->display_name }}
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  @foreach($group_item->permissions as $menu_item)
                    <a class="nav-link js-scroll-trigger navBtn {{ Request::is($menu_item->name.'*') ? 'navActive' : '' }}" href="{{env('PUBLIC_URL', 'http://localhost/public').'/'.$menu_item->name}}" id="{{ $menu_item->name }}">{{ $menu_item->display_name }}</a>
                  @endforeach
                  </div>
                </li>
              @elseif(sizeOf($group_item->permissions) > 0)
                <li class="nav-item">
                  <a class="nav-link js-scroll-trigger navBtn {{ Request::is($group_item->permissions[0]->name.'*') ? 'navActive' : '' }}" href="{{env('PUBLIC_URL', 'http://localhost/public').'/'.$group_item->permissions[0]->name}}" id="{{ $group_item->permissions[0]->name }}">{{ $group_item->permissions[0]->display_name }}</a>
                </li>
              @endif
            @endforeach

          @endif
          @if( !isset(Auth::user()->name) )
            <li class="nav-item loginNav">
              <a class="nav-link js-scroll-trigger navBtn" href="{{ url('/login') }}"> <img src="{{ asset('img/info/icono_iniciarsesion.png') }}" alt="" id="Inicio"> &nbsp; Iniciar Sesión</a>
            </li>
          @else
            <li class="nav-item loginNav">
              <a class="nav-link js-scroll-trigger navBtn" href="{{ url('/logout') }}"> Cerrar Sesión</a>
            </li>
          @endif
        </ul>
      </div>
    </div>
  </nav>
