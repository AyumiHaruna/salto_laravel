@extends('layouts.mainLayoutSession')


  @section('title') AUDIOS - NUEVO AUDIO  @endsection

  @section('extraheader')
    <link rel="stylesheet" href="{{ asset('css/resources/audios_admin.css') }}">
  @endsection

  @section('in_page_title') NUEVO AUDIO  @endsection

  @section('content')
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 mainContainer">
          <form name="formAudio" id="formAudio" action="{{ url('/Admin_Audios/new_audio/save') }}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}

            <div class="row form_block">
              <div class="col-sm-2 offset-sm-1 text-right form_sub_block">
                <button type="button" class="upload_div_btn" id="upload_audio_btn" style="background-image: url('{{ asset('img/web/admin_elements/Upload_button.png') }}')">
                  subir <br>
                  <b>AUDIO</b><br>
                  <img src="{{ asset('img/web/admin_elements/icono_subir_foto.png') }}">
                </button>

                <button type="button" class="upload_div_btn" id="upload_img_btn" style="background-image: url('{{ asset('img/web/admin_elements/Upload_button.png') }}')">
                  subir <br>
                  <b>IMAGEN</b> <br>
                  <img src="{{ asset('img/web/admin_elements/ICON_image.png') }}">
                </button>
              </div>
              <div class="col-sm-6 form_sub_block">
                <div class="row">
                  <div class="col-sm-4 text-center">
                    <img src="{{ asset('img/web/admin_elements/Miniatura.png') }}" class="thumb_preview" id="thumb_preview">
                  </div>
                  <div class="col-sm-8 progress_block">
                    <div class="row">
                      <div class="col-sm-12">
                        <div id="myProgress" style="background-image: url('{{ asset('img/web/admin_elements/barra_de_progreso.png') }}')">
                          <div id="myBar"></div>
                        </div>
                        <p id="uploading_msg"> Subiendo <span id="upl_span"></span>: <span id="per_span">0</span>% <br> </p>
                      </div>
                      <div class="col-sm-12">
                        <img src="{{ asset('img/web/admin_elements/sound_off.png') }}" alt="" class="img_lock" id="preview_audio"> <span class="span_lock" id="audio_span">Aun no se ha cargado el audio</span>
                      </div>
                      <div class="col-sm-12">
                        <img src="{{ asset('img/web/admin_elements/lock_off.png') }}" alt="" class="img_lock" id="img_lock"> <span class="span_lock" id="lock_span">Contenido libre para cualquier usuario</span>
                      </div>
                      <div class="col-sm-12 text-right">
                        Categoría: "{{ $category_name }}"
                      </div>
                    </div>
                  </div>

                  <input type="file" name="thumbnail" id="thumbnail" style="display:none;" accept="image/png, image/jpeg" required>
                  <input type="file" name="audio" id="audio" style="display:none;" accept="audio/mp3, audio/mp4" required>
                  <input type="hidden" name="url" id="url" value="">
                  <input type="hidden" name="thumb_url" id="thumb_url" value="">
                  <input type="checkbox" name="premium_lock" id="premium_lock" value="1" style="display:none;">
                  <input type="hidden" name="category" value="{{ $id_category }}">

                  <div class="col-sm-12 form_block_element" style="background-image: url('{{ asset('img/web/admin_elements/titulo.png') }}')">
                    <input type="text" name="title" class="form-control" placeholder="Titulo" id="title" value="{{ old('title') }}" required>
                  </div>

                  <div class="col-sm-12 form_block_element" style="background-image: url('{{ asset('img/web/admin_elements/descripcion.png') }}')">
                    <textarea name="description" class="form-control" placeholder="Descripción" rows="4" cols="50" id="description" required>{{ old('description') }}</textarea>
                  </div>

                  <div class="col-sm-12 text-right">
                    <button type="button" name="button" class="form_action_button" id="form_submit" style="background-image: url('{{ asset('img/web/admin_elements/Boton_publicar_cancelar.png') }}')">Publicar</button>
                    <a href="{{ url('Admin_Audios') }}"> <button type="button" name="button" class="form_action_button" style="background-image: url('{{ asset('img/web/admin_elements/Boton_publicar_cancelar.png') }}')">Cancelar</button> </a>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  @endsection


  @section('jqueryScripts')
    <script type="text/javascript">
      $(document).ready(function() {

          @IF ( Session::get('msg') != null )
            showAlert("error", "{{Session::get('msg')}}")
          @ENDIF

          // trigger file input
          $("#upload_img_btn").click(function(){
            $("#thumbnail").trigger('click');
          });
          $("#upload_audio_btn").click(function(){
            $("#audio").trigger('click');
          });
          $("#img_lock").click(function(){
            if( $("#premium_lock").is(':checked') ){
              $("#premium_lock").attr('checked', false);
              $("#img_lock").attr('src', "{{ asset('img/web/admin_elements/lock_off.png') }}");
              $("#lock_span").html('Contenido libre para cualquier usuario');

            } else {
              $("#premium_lock").attr('checked', true);
              $("#img_lock").attr('src', "{{ asset('img/web/admin_elements/lock_on.png') }}");
              $("#lock_span").html('Contenido para usuarios premium');
            }
          })

          //animate progress bar if input thumbnail change
          $("#thumbnail").change(function(e){
              $("#thumb_preview").attr('src', "{{ asset('img/web/admin_elements/Miniatura.png') }}");
              //set name of the file
              var fileExtension = ['jpeg', 'jpg', 'png'];
              //if file is diferente extension
              if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                  $("#thumbnail").val('');
                  $("#thumb_url").val('');
                  $("#thumb_preview").attr('src', '{{ asset('img/web/admin_elements/Miniatura.png') }}');
                  ($("#myBar")[0]).style.width = '0%';
                  $("#uploading_msg").hide();
                  alert("Solo se permiten archivos tipo : "+fileExtension.join(', '));
              } else {
                var fileName = e.target.files[0].name;
                $("#thumb_url").val(fileName);
                ($("#myBar")[0]).style.width = '0%';
                $("#upl_span").html('imagen miniatura');
                $("#uploading_msg").show();
                changePreview(this);
                animateBar('image');
              }
          });

          //animate progress bar if input thumbnail change
          $("#audio").change(function(e){
              $("#preview_audio").attr('src', '{{ asset("img/web/admin_elements/sound_off.png") }}');
              $("#audio_span").html('Aun no se ha cargado el audio');
              //set name of the file
              var fileExtension = ['mp3', 'mp4'];
              //if file is diferente extension
              if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                  $("#audio").val('');
                  $("#url").val('');
                  ($("#myBar")[0]).style.width = '0%';
                  $("#uploading_msg").hide();
                  alert("Solo se permiten archivos tipo : "+fileExtension.join(', '));
              } else {
                var fileName = e.target.files[0].name;
                $("#url").val(fileName);
                ($("#myBar")[0]).style.width = '0%';
                $("#upl_span").html('audio');
                $("#uploading_msg").show();
                animateBar('audio');
              }
          });

          //validate form
          $("#form_submit").click(function(){
            if( $("#title").val() != '' ){
              if( $("#description").val() != '' ){
                if( $("#url").val() != '' ){
                  if( $("#thumb_url").val() != '' ){
                    $( "#formAudio" ).submit();
                  } else {
                      alert('falta cargar una imagen miniatura');
                  }
                } else {
                    alert('falta cargar un audio');
                }
              } else {
                  alert('falta capturar la descripción');
              }
            } else {
                alert('falta capturar el título');
            }
          });

          //intercambia la imagen en miniatura
          function changePreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#thumb_preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
          }

          function animateBar(type){
            var elem = $("#myBar")[0];
            var width = 1;
            var id = setInterval(frame, 10);
            function frame() {
              if (width >= 100) {
                clearInterval(id);
                if( type == 'audio'){
                  $("#preview_audio").attr('src', '{{ asset("img/web/admin_elements/sound_on.png") }}');
                  $("#audio_span").html('Audio cargado exitosamente');
                }
              } else {
                width++;
                elem.style.width = width + '%';
                $("#per_span").html(width);
              }
            }
          }

      });
    </script>
  @endsection
