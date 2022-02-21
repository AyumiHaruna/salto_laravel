@extends('layouts.mainLayout')

  <!--    HEAD      -->
  @section('title') Blog - {{ ((isset($post))? 'Modificar post' : 'Nuevo post' ) }} @endsection

  @section('extraheader')
    <link rel="stylesheet" href="{{ asset('css/blog/style.css') }}">

    <!--   SUMMERNOTE   -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script src="{{ asset('js/lang/summernote-es-ES.js') }}"></script>

    <!-- upload file -->
    <link href="{{ asset('css/uploadfile.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery.uploadfile.min.js') }}"></script>

    <!-- miltiSelect js -->
    <link href="{{ asset('css/multi-select.css') }}" media="screen" rel="stylesheet" type="text/css">
    <script src="{{ asset('js/jquery.multi-select.js') }}" type="text/javascript"></script>

    <!-- jquery ui -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
  @endsection


  @section('content')



      <div class="container" id="mainContainer">
        <div class="row">
          <div class="col-md-12 miniLogo">
              <img src="{{ asset('img/info/icono_saltum.png') }}" alt="icono saltum" id="colorIcon">
          </div>

          <div class="col-md-12 sectionTitle">
            <h1>{{ ((isset($post))? 'Modificar post' : 'Crear nuevo post' ) }}</h1>
          </div>
        </div>

        <div class="row justify-content-md-center" style="margin-top: -50px;">
          <div class="col-md-10">

            <form class="" action="{{ url((($blog_admin == true)? 'Admin_Blog' : 'Blog' ).'/post/store') }}" method="post" enctype="multipart/form-data">
              {!! csrf_field() !!}

              <input type="hidden" name="type" value="{{ ((isset($post))? 'update' : 'create' ) }}">
              <input type="hidden" name="id" value="{{ ((isset($post))? $post['id'] : 0 ) }}">

              <div class="row">
                  <div class="col-md-12">
                    <label for="titulo">Título:</label>
                    <input type="text" name="titulo" class="form-control" id="titulo"  value="{{ ((isset($post))? $post['titulo'] : "" ) }}" required>
                  </div>

                  <div class="col-md-12">
                    <label for="metatag">Meta Tag:</label>
                    <input type="text" name="metatag" class="form-control" id="metatag"  value="{{ ((isset($post))? $post['metatag'] : "" ) }}" required>
                  </div>

                  <div class="col-md-6">
                    <label for="tema">Tema:</label>

                      @IF( count($themes) == 0 )
                        No existe ninguna categoría

                      @ELSE
                        <!-- <select class="form-control" name="tema[]" id='temas' multiple='multiple'> -->
                        <select class="form-control" name="tema[]" id='temas' multiple='multiple' required>
                            @FOR($x = 0; $x < count($themes); $x++)
                              <option value="{{ $themes[$x]['id'] }}"
                              @IF( isset($catList) )
                                @FOR($y=0; $y<count($catList); $y++)
                                   {{ (( $themes[$x]['id'] == $catList[$y]['id_Tema'] )? ' selected' : '') }}
                                @ENDFOR
                              @ENDIF
                              > {{ $themes[$x]['descripcion'] }} </option>
                            @ENDFOR
                        </select>
                      @ENDIF
                    <br>
                    <label for="pulbiDate">Fecha de publicación</label>
                    <input type="text" name="publiDate" id="publiDate" class="form-control" value="{{ ((isset($post))? substr($post['publiDate'],0 ,10) : "" ) }}" autocomplete="off" required>
                    <br>
                  </div>

                  <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-12">
                        <label for="foto">Imagen de portada:</label>
                        <input type="text" name="foto" id="foto" class="form-control" value="{{ ((isset($post))? $post['foto'] : "" ) }}" readonly required>
                      </div>
                    </div>
                    <div id="fotoUpload" class="col-md-12"></div>
                    <div class="col-md-12 text-center">
                      <img src="{{ ((isset($post))? asset('img/imgTemas').'/'.$post['foto'] : asset('img/imgTemas/preview.png') ) }}" alt="imgTema" id="imgPreview" class="imgPreview">
                    </div>
                  </div>

                  <!--    WYSIWYG Editor    -->
                  <div class="col-md-12">
                    <textarea id="summernote" name="mensaje" required> {{ ((isset($post))? $post['mensaje'] : "" ) }} </textarea>
                  </div>

                  <div class="col-md-12 text-center">
                    <label for="visible">¿Guardar post como visible?</label>
                    <input type="checkbox" name="visible" value="1"
                      @IF( isset($post) )
                        {{ (( $post->visible == 1 )? ' checked' : '') }}
                      @ENDIF
                    ><br>
                    (Aun siendo visible, estará sujeto a la fecha de publicación).
                  </div>

                  <div class="col-md-12 text-center" style="margin-top: 25px;">
                    <button type="sumbit" class="btn btn-primary"> {{ ((isset($post))? 'Modificar' : 'Guardar' ) }} Post</button>
                  </div>
              </div>
            </form>

          </div>
        </div>
      </div>


  @endsection

  @section('jqueryScripts')
    <script type="text/javascript">
      $(document).ready(function(){
          //------------------------------------------
          //                VARS
          //-----------------------------------------
          var themeList = {!! json_encode($themes) !!};
          $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

          $('#pre-selected-options').multiSelect();

          //------------------------------------------
          //          INITIAL CONDITIONS
          //-----------------------------------------
          // summernote
          $('#summernote').summernote({
            lang: 'es-ES',
            height: 200,
            toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'italic', 'underline', 'clear', 'strikethrough', 'superscript', 'subscript']],
              ['fontname', ['fontname']],
              ['fontsize', ['fontsize']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['height', ['height']],
              ['table', ['table']],
              ['insert', ['link', 'picture', 'hr']],
              ['view', ['fullscreen', 'codeview']],
              ['help', ['help']]
           ]

          });

          // fix summernote toggle issues with bootstrap 4
          $('.dropdown-toggle').dropdown()

          // enable multiselect field
          $('#temas').multiSelect()

          // enable datepicker
          $("#publiDate").datepicker({
            dateFormat: "yy-mm-dd",
            altFormat: "yy-mm-dd"
          });

          //          AJAX FUNCTIONS
          //-----------------------------------------
          // Ajax function to upload images
          $("#fotoUpload").uploadFile({
              url:"{{ url((($blog_admin == true)? 'Admin_Blog' : 'Blog' ).'/categories/postImg') }}",    //same url for upload img linke categories
              fileName:"myfile",
              multiple: false,
              allowedTypes: "jpg,jpeg,png,gif",
              onSuccess:function(files,data,xhr,pd){
                if(data != 'error'){
                  $("#foto").val(data);
                  $("#fileupload, .ajax-file-upload-container").hide();
                  $("#imgPreview").attr('src', '{{ url("img/imgTemas") }}/'+data);
                } else {
                  //if ajax upload - server fail
                }
              }
          });

          //------------------------------------------
          //          DOM FUNCTIONS
          //-----------------------------------------
          // simulate readOnly on pulbiDate input
          $("#publiDate").on('keydown paste', function(e){
              e.preventDefault();
          });
      });
    </script>
  @endsection
