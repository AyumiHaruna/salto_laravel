@extends('layouts.mainLayoutSession')


  @section('title') {{ $section->display_name }} @endsection

  @section('extraheader')
    <link rel="stylesheet" href="{{ asset('css/resources/audios_admin.css') }}">
  @endsection

  @section('in_page_title') CATEGORÍAS  @endsection

  @section('content')
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 mainContainer">

          <!-- action float buttons -->
          <div class="float_action_btns text-center">
            <a href="{{ url('/Admin_Audios/new_category') }}">
              <button type="button" name="button" id="add_category_btn" class="add_category_btn"><i class="fas fa-plus fa-lg"></i></button>
              <br>
              Agregar <br>
              nueva <br>
              categoría
            </a>
          </div>

          <!-- category - audio block -->
          <div class="row">
            <div class="col-sm-10 offset-sm-1">
              <div class="row">

                @IF( count($categories) > 0 )
                  @FOREACH( $categories AS $key => $cat )
                    <div class="col-md-3 category_block">
                        <div class="col-sm-12 text-right">
                          <!-- <a href="{{ url('Admin_Audios/upd_category/'.$cat['id']) }}"><button type="button" name="button" class="add_audio_btn">Editar</button> </a> &nbsp; -->
                          <a href="{{ url('Admin_Audios/new_audio/'.$cat['id']) }}"><button type="button" name="button" class="add_audio_btn">Agregar</button> </a>
                        </div>

                        <div class="col-sm-12 category_header" style="background: url(' {{ asset('img/web/audios/'.$cat['thumbnail']) }} ');">
                          <span>{{ $cat['category'] }}</span>
                          <br>
                          {{ $cat['description'] }}
                        </div>

                        <div class="col-sm-12 category_body">
                            @FOREACH($cat['audios'] AS $key2 => $audio)
                            <div class="row audio_block">
                              <div class="col-sm-3 thumb_container">
                                <img src="{{ asset('img/web/audios/'.$audio['thumbnail']) }}" alt="" class="audio_thumb">
                              </div>
                              <div class="col-sm-9 card_info_container">
                                <span class="audio_title">{{ $audio['title'] }}</span><br>
                                {{$audio['description']}} <br>
                                 <span class="audio_status">Status: {{ (($audio['lock'] == 0)? 'público' : 'premium' ) }} </span><br>
                                <a href="{{ url('/Admin_Audios/mod_audio') }}/{{ $audio['id'] }}"> <button type="button" class="audio_action_btn" name="button" style="background-image: url(' {{ asset('img/web/admin_elements/Boton_editar_mover_borrar_categoria.png') }} ');">Editar</button> </a>
                                <!-- <button type="button" class="audio_action_btn audio_action_mover" metaId="{{ $audio['id'] }}" name="button" style="background-image: url(' {{ asset('img/web/admin_elements/Boton_editar_mover_borrar_categoria.png') }} ');">Mover</button> -->
                                <button type="button" class="audio_action_btn audio_action_borrar" metaId="{{ $audio['id'] }}" name="button" style="background-image: url(' {{ asset('img/web/admin_elements/Boton_editar_mover_borrar_categoria.png') }} ');">Borrar</button>
                                <button type="button" class="audio_action_btn audio_action_play" name="button" style="background-image: url(' {{ asset('img/web/admin_elements/Boton_editar_mover_borrar_categoria.png') }} ');"><i class="fas fa-play"></i></button>
                                <button type="button" class="audio_action_btn audio_action_stop" name="button" style="background-image: url(' {{ asset('img/web/admin_elements/Boton_editar_mover_borrar_categoria.png') }} '); display:none;"><i class="fas fa-stop"></i></button>

                                  <audio controls preload="none" id="audio_{{ $audio['id'] }}" loop style="display:none;">
                                    <source src="{{ asset('img/web/audios/'.$audio['url']) }}" type="audio/mpeg">
                                    Tu navegador no soporta este elemento.
                                  </audio>
                              </div>
                            </div>
                            @ENDFOREACH
                        </div>
                    </div>
                  @ENDFOREACH
                @ELSE
                  <div class="col-sm-3 category_block">
                      Aún no existen categorías
                  </div>
                @ENDIF

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

          $(".audio_action_borrar").click(function(){
              if(confirm("¿Desea eliminar este audio?")) {
                  $("#id_selected").val( $(this).attr('metaId') );
                  $('#hiddenValues').attr('action', "{{ url('/Admin_Audios/delete_audio') }}");
                  $( "#hiddenValues" ).submit();
              }
          });

          $(".audio_action_play").click(function(){
            var thisParent = $(this).parent();
            var audio = thisParent.children('audio');
            var showBtn = thisParent.children(".audio_action_stop");
             $(this).hide();
             audio[0].play();
             showBtn.show();
          });

          $(".audio_action_stop").click(function(){
            var thisParent = $(this).parent();
            var audio = thisParent.children('audio');
            var showBtn = thisParent.children(".audio_action_play");
             $(this).hide();
             audio[0].pause();
             audio[0].currentTime = 0;
             showBtn.show();
          });
      });
    </script>
  @endsection
