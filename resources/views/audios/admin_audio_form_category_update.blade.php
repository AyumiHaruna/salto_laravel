@extends('layouts.mainLayoutSession')


  @section('title') AUDIOS - MODIFICAR CATEGORÍA  @endsection

  @section('extraheader')
    <link rel="stylesheet" href="{{ asset('css/resources/audios_admin.css') }}">
  @endsection

  @section('in_page_title') MODIFICAR CATEGORÍA  @endsection

  @section('content')
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 mainContainer">
          <form name="formAudio" id="formAudio" action="{{ url('/Admin_Audios/upd_category/save') }}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="row form_block">
              <div class="col-sm-2 offset-sm-1 text-right form_sub_block">
                <button type="button" class="upload_div_btn" id="upload_div_btn" style="background-image: url('{{ asset('img/web/admin_elements/Upload_button.png') }}')">
                  subir <br>
                  <b>IMAGEN</b> <br>
                  <img src="{{ asset('img/web/admin_elements/ICON_image.png') }}">
                </button>
              </div>
              <div class="col-sm-6 form_sub_block">
                <div class="row">
                  <div class="col-sm-4 text-center">
                    <input type="file" name="thumbnail" id="thumbnail" style="display:none;" accept="image/png, image/jpeg" required>
                    <img src="{{ asset('img/web/audios/'.$data['thumbnail']) }}" class="thumb_preview" id="thumb_preview">
                  </div>
                  <div class="col-sm-8 progress_block">
                    <input type="hidden" name="url" id="url" value="">
                    <div id="myProgress" style="background-image: url('{{ asset('img/web/admin_elements/barra_de_progreso.png') }}')">
                      <div id="myBar"></div>
                    </div>
                    <p id="uploading_msg"> Subiendo imágen miniatura: <span>0</span>% <br> </p>
                  </div>

                  <div class="col-sm-12 form_block_element" style="background-image: url('{{ asset('img/web/admin_elements/titulo.png') }}')">
                    <input type="text" name="category" class="form-control" placeholder="Nombre" id="category" value="{{ $data['category'] }}" required>
                  </div>

                  <div class="col-sm-12 form_block_element" style="background-image: url('{{ asset('img/web/admin_elements/descripcion.png') }}')">
                    <textarea name="description" class="form-control" placeholder="Descripción" rows="4" cols="50" id="description" required>{{ $data['description'] }}</textarea>
                  </div>

                  <div class="col-sm-12 text-right">
                    <button type="button" name="button" class="form_action_button" id="form_submit" style="background-image: url('{{ asset('img/web/admin_elements/Boton_publicar_cancelar.png') }}')">Editar</button>
                    <a href="{{ url('Admin_Audios') }}"> <button type="button" name="button" class="form_action_button" style="background-image: url('{{ asset('img/web/admin_elements/Boton_publicar_cancelar.png') }}')">Cancelar</button> </a>
                  </div>
                </div>
              </div>
            </div>
            <input type="hidden" name="id_cat" value="{{ $data['id'] }}">
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

          $("#upload_div_btn").click(function(){
            $("#thumbnail").trigger('click');
          });

          $("#thumbnail").change(function(e){
              //set name of the file
              var fileExtension = ['jpeg', 'jpg', 'png'];
              if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                  $("#thumbnail").val('');
                  $("#url").val('');
                  $("#thumb_preview").attr('src', '{{ asset('img/web/admin_elements/Miniatura.png') }}');
                  ($("#myBar")[0]).style.width = '0%';
                  $("#uploading_msg").hide();
                  alert("Solo se permiten archivos tipo : "+fileExtension.join(', '));
              } else {
                var fileName = e.target.files[0].name;
                $("#url").val(fileName);
                ($("#myBar")[0]).style.width = '0%';
                $("#uploading_msg").show();
                changePreview(this);
                animateBar();
              }
          });

          $("#form_submit").click(function(){
              if( $("#category").val() != '' ) {
                  if( $("#description").val() != '' ) {
                      $( "#formAudio" ).submit();
                  } else {
                    alert('falta capturar la descripción');
                    $("#description").focus();
                  }
              } else {
                alert('falta capturar el nombre de la categoría');
                $("#category").focus();
              }
          });

          function changePreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#thumb_preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
          }

          function animateBar(){
            var elem = $("#myBar")[0];
            var width = 1;
            var id = setInterval(frame, 10);
            function frame() {
              if (width >= 100) {
                clearInterval(id);
              } else {
                width++;
                elem.style.width = width + '%';
                $(".progress_block span").html(width);
              }
            }
          }

      });
    </script>
  @endsection
