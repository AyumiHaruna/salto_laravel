@extends('layouts.mainLayoutSession')


  @section('title') {{ $section->display_name }} @endsection

  @section('extraheader')
    <link rel="stylesheet" href="{{ asset('css/resources/videos_admin.css') }}">
  @endsection

  @section('in_page_title') VIDEOS  @endsection

  @section('content')
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 mainContainer">

          <!-- action float buttons -->
          <div class="float_action_btns text-center">
            <a href="{{ url('/Admin_Videos/new_video') }}">
              <button type="button" name="button" id="add_video_btn" class="add_video_btn"><i class="fas fa-plus fa-lg"></i></button>
              <br>
              Agregar <br>
              nuevo <br>
              video
            </a>
          </div>

          <div class="row">
            <div class="col-sm-10 offset-sm-1">
              <div class="row justify-content-between">
                @FOREACH( $videos AS $key => $video )
                  <div class="col-sm-5">
                    <div class="row">
                      <div class="col-sm-6">
                          <video poster="{{ asset('img/web/videos/'.$video['thumbnail']) }}" class="videoframe" id="{{$video['id']}}">
                            <source src="{{ asset('img/web/videos/'.$video['url']) }}" type="video/mp4">
                            Tu navegador no soporta este formato de video
                          </video>
                          @IF( $video['lock'] == 1 )
                            <img src="{{ asset('img/web/admin_elements/icono_candado_white.png') }}" alt="" class="video_lock_icon">
                          @ENDIF
                      </div>
                      <div class="col-sm-6 video_action">
                        <span>{{ $video['title'] }}</span><br>
                        <span id="duration-{{ $video['id'] }}"></span><br>
                        <a href="{{ url('/Admin_Videos/upd_video/'.$video['id']) }}"><button type="button" name="button" class="video_action_button" style="background-image: url('{{asset('img/web/admin_elements/Boton_editar_mover_borrar.png')}}');">Editar</button></a>
                        <!-- <button type="button" name="button" class="video_action_button" style="background-image: url('{{asset('img/web/admin_elements/Boton_editar_mover_borrar.png')}}');">Mover</button> -->
                        <button type="button" name="button" class="video_action_button video_action_borrar" metaId="{{ $video['id'] }}" style="background-image: url('{{asset('img/web/admin_elements/Boton_editar_mover_borrar.png')}}');">Borrar</button>
                      </div>
                    </div>
                  </div>
                @ENDFOREACH
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <form id="hiddenValues" method="post">
      {!! csrf_field() !!}
      <input type="hidden" name="id_selected" id="id_selected" value="">
    </form>

  @endsection


  @section('jqueryScripts')
    <script type="text/javascript">
      $(document).ready(function() {

          @IF ( Session::get('msg') != null )
            showAlert("{{ ((Session::get('status') == 200)? 'ok' : 'error' ) }}", "{{Session::get('msg')}}")
          @ENDIF

          //toggle video controls
          $(".videoframe").hover(function(event) {
              if(event.type === "mouseenter") {
                  $(this).attr("controls", "");
                  $("#duration-"+ $(this).attr('id') ).html( ($(this)[0].duration).toFixed(2) +'s' );
              } else if(event.type === "mouseleave") {
                  $(this).removeAttr("controls");
              }
          });

          //ask if is ok delete video
          $(".video_action_borrar").click(function(){
              if(confirm("¿Desea eliminar este video?")) {
                  $("#id_selected").val( $(this).attr('metaId') );
                  $('#hiddenValues').attr('action', "{{ url('/Admin_Videos/delete_video') }}");
                  $( "#hiddenValues" ).submit();
              }
          });


          $(".video_action_play").click(function(){
            var thisParent = $(this).parent();
            var audio = thisParent.children('audio');
            var showBtn = thisParent.children(".audio_action_stop");
             $(this).hide();
             audio[0].play();
             showBtn.show();
          });

          $(".video_action_stop").click(function(){
            var thisParent = $(this).parent();
            var audio = thisParent.children('audio');
            var showBtn = thisParent.children(".audio_action_play");
             $(this).hide();
             audio[0].pause();
             audio[0].currentTime = 0;
             showBtn.show();
          });

          $(".close_iframe").click(function(){
            $('.transparency, .iframe_div').hide();
          });

      });
    </script>
  @endsection
