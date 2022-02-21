@extends('layouts.mainLayout')

  <!--    HEAD      -->
  @section('title') Blog - Entrada @endsection

  @section('extraheader')
    <!--   SUMMERNOTE   -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
    <script src="{{ asset('js/lang/summernote-es-ES.js') }}"></script>

    <!--  simpleUpload  -->
    <!-- <script src="{{ asset('js/jquery.dm-uploader.js') }}"></script> -->

    <style media="screen">
      #imgTema{
        width: 100px;
      }
    </style>
  @endsection


  <!--    BODY     -->
  @include('partials._menu')


  @section('content')



      <div class="container">
        <div class="row">
          <div class="col-md-12">
              <h3>Welcome to SALTUM BLOG->Entrada->Create</h3>
          </div>
        </div>

        <div class="row justify-content-md-center">
          <div class="col-md-10">
            <form class="" action="{{ url('admin/blog/entrada/guardar') }}" method="post" enctype="multipart/form-data">
              {!! csrf_field() !!}

              <div class="row">
                  <div class="col-md-12">
                    <label for="titulo">Título:</label>
                    <input type="text" name="titulo" class="form-control" id="titulo" value="{{$entrada->titulo}}" required>
                  </div>
                  <div class="col-md-6">
                    <label for="tema">Tema:</label>
                    <select class="form-control" name="tema" id="tema" required>
                      @if( count($temas) == 0 )
                        <option value="">Lista de Temas Vacía</option>
                      @else
                        <option value="">--Seleccione un Tema</option>
                        @for($x = 0; $x < count($temas); $x++)
                          <option value="{{$temas[$x]['id']}}" {{ (($temas[$x]['id'] == $entrada->id_tema)? 'selected' : '') }}> {{$temas[$x]['descripcion']}}  </option>
                        @endfor
                      @endif
                    </select>
                  </div>
                  <div class="col-md-6">
                    <img src="{{ asset('img/imgTemas') }}/{{$entrada->temaFoto}}" alt="imgTema" id="imgTema">
                  </div>

                  {{ $entrada->id_tema }}

                  <!--    WYSIWYG Editor    -->
                  <div class="col-md-12">
                    <textarea id="summernote" name="mensaje" rows="5" required>{{ $entrada->mensaje }}</textarea>
                  </div>

                  <div class="col-md-6">
                    <input type="file" name="adjuntos[]" multiple>
                  </div>
                  <div class="col-md-6">
                    <span>previews</span>
                  </div>

                  <div class="col-md-3">
                    <label for="visible">Publicar al Guardar</label>
                    <input type="checkbox" name="visible" value="1">
                  </div>

                  <div class="col-md-6">
                    <button type="sumbit" class="btn btn-block btn-primary">Guardar Entrada</button>
                  </div>
              </div>

            </form>

          </div>
        </div>
      </div>


  @endsection


  <script type="text/javascript">
    $(document).ready(function(){
        //------------------------------------------
        //                VARIABLES
        //-----------------------------------------
        var listaTemas = {!! json_encode($temas) !!};

        //------------------------------------------
        //          CONDICIONES INICIALES
        //-----------------------------------------
        // summernote
        $(  '#summernote').summernote({
          lang: 'es-ES'
        });
        $('.dropdown-toggle').dropdown()

        //------------------------------------------
        //          FUNCIONES GENERALES
        //-----------------------------------------

        //------------------------------------------
        //          FUNCIONES DEL DOM
        //-----------------------------------------
        // muestra un preview de la imagen ligada al tema
        $("#tema").on("change", function(){
          if( $(this).val() == "" ) {
            $("#imgTema").attr('src', '{!! asset('/img/imgTemas') !!}/preview.png');
          }
          else{
            for (var i = 0; i < listaTemas.length; i++) {
              if ( listaTemas[i]['id'] == $(this).val() ) {
                $("#imgTema").attr('src', '{!! asset('/img/imgTemas') !!}/'+listaTemas[i]['foto']);
              }
            }
          }
        });



        // sube un archivo al servidor
        // $('input[type=file]').change(function(){
      	// 	$(this).simpleUpload("{{ url('admin/blog/entrada/guardarArchivo') }}", {
      	// 		start: function(file){
      	// 			//upload started
      	// 			console.log("upload started");
      	// 		},
        //
      	// 		progress: function(progress){
      	// 			//received progress
      	// 			console.log("upload progress: " + Math.round(progress) + "%");
      	// 		},
        //
      	// 		success: function(data){
      	// 			//upload successful
      	// 			console.log("upload successful!");
      	// 			console.log(data);
      	// 		},
        //
      	// 		error: function(error){
      	// 			//upload failed
      	// 			console.log("upload error: " + error.name + ": " + error.message);
      	// 		}
      	// 	});
            //
            // $.ajax({
            //         data:  { "_token": "{{ csrf_token() }}", anio:'testing' },
            //         url:   "{{ url('admin/blog/entrada/guardarArchivo') }}", //archivo que recibe la peticion
            //         type:  "post", //método de envio
            //         success:  function (data) { //una vez que el archivo recibe el request lo procesa y lo devuelve
            //                 console.log(data);
            //         }
            // });
      	// });
    });
  </script>
