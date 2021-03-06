@extends('layouts.mainLayout')

  @section('title') Blog Coaching @endsection

  @section('extraheader')
    <link rel="stylesheet" href="{{ asset('css/blog/style.css') }}">

    <!-- upload file -->
    <link href="{{ asset('css/uploadfile.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery.uploadfile.min.js') }}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="Conoce estrategias que te ayuden a alcanzar tus metas en diferentes áreas de tu vida.">
  @endsection


  @section('content')


    <div class="col-md-12 transparencyBG"></div>

    <div class="col-md-12 hoverBlock" id="mainContainer">
      <div class="row">
        <div class="col-md-6 offset-md-3 hoverForm">
          <form name="formCategorie" id="formCategorie" action="{{ url((($blog_admin == true)? 'Admin_Blog' : 'Blog' ).'/categorie/create') }}" method="post" enctype="multipart/form-data">

            {!! csrf_field() !!}
            <div class="row">
              <div class="col-md-12 text-right">
                <button type="button" class="closeFormBtn"> <i class="fas fa-window-close fa-2x"></i> </button>
              </div>
              <div class="col-md-12 formTitle">
                Nueva Categoría
              </div>
              <input type="hidden" name="id" id="idHidden">
              <div class="col-md-12 formBlock">
                <label for="descripcion">Descripción:</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control" required>
              </div>

              <div class="col-md-6 formBlock">
                <div class="row">
                  <div class="col-md-12">
                    <label for="foto">Foto:</label>
                    <input type="text" name="foto" id="foto" class="form-control" placeholder="Nombre de la foto" readOnly required><br>
                  </div>
                  <div id="fileupload" class="col-md-12">

                  </div>
                </div>
              </div>

              <div class="col-md-6 text-center formBlock">
                <img src="{{ asset('img/imgTemas/preview.png') }}" alt="" id="imgPreview">
              </div>

              <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-info" id="sendBtn">Guardar</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>



  <div class="container" id="mainContainer">
    <div class="row">

      <div class="col-md-12 miniLogo">
          <img src="{{ asset('img/info/icono_saltum.png') }}" alt="icono saltum" id="colorIcon">
      </div>
      <div class="col-md-12 sectionTitle">
        <h1>Categorías</h1>

        @IF($errors->any())
          <span style="color:red">{{$errors->first()}}</span>
        @ENDIF

        @IF(session('success'))
            <span style="color:green">{{session('success')}}</span>
        @ENDIF
      </div>

      @IF( $blog_admin == true  )
        <div class="col-md-12 text-right">
          <a href="#"> <button type="button" name="button" class="btn btn-dark btn-lg" id="newCategorie"> Nueva Categoría &nbsp; <i class="fas fa-plus"></i> </button> </a>
        </div>
      @ENDIF
    </div>

    <div class="row justify-content-md-center blogBlock">
      @FOREACH($temas as $tema)
        @IF( $blog_admin == true || $tema['activo'] == 1 )
          <div class="col-sm-4" data-aos="fade-right" data-aos-duration="300" {{ (( $tema->activo == 0 )? 'style=opacity:0.5' : '' ) }} id="block{{$tema->id}}">
            <div class="row">
              <div class="col-md-12 blogSquare">
                <a href="{{ url( (($blog_admin == true)? 'Admin_Blog' : 'Blog' ).'/post/show/'.$tema['display_url']) }}">
                  <img src="{{ asset('img/imgTemas/'.$tema['foto']) }}" alt="" class="blogImg">
                  <div class="blogTitle">{{ $tema['descripcion'] }}</div>
                </a>

                    @IF( $blog_admin == true  )
                        <button type="button" name="button" class="btn btn-block btn-info btn-lg editCategorieBtn" id="{{ $tema['id'] }}"> Editar Categoría &nbsp; <i class="fas fa-pencil-alt"></i> </button>
                        @IF( $tema['activo'] == 1 )
                          <button type="button" name="button" class="btn btn-block btn-warning btn-lg toggleBtn" metaId="{{ $tema['id'] }}" metaStat="{{ $tema['activo'] }}"> Deshabilitar Categoría &nbsp; <i class="fas fa-eye-slash"></i> </button>
                        @ELSEIF( $tema['activo'] == 0 )
                          <button type="button" name="button" class="btn btn-block btn-warning btn-lg toggleBtn" metaId="{{ $tema['id'] }}" metaStat="{{ $tema['activo'] }}"> Habilitar Categoría &nbsp; <i class="far fa-eye"></i> </button>
                        @ENDIF
                    @ENDIF

              </div>
            </div>
          </div>
        @ENDIF
      @ENDFOREACH
    </div>
  </div>

  @endsection



  @section('jqueryScripts')
    <script type="text/javascript">
      $(document).ready(function(){
        //------------------------------------------
        //            GENERAL VARS
        //------------------------------------------
        var catList = {!! $temas !!};
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        //------------------------------------------
        //            DOM FUNCTIONS
        //------------------------------------------
        //show the edit menu
        $("#newCategorie, .editCategorieBtn").on('click', function(){
          if( $(this).attr("id") == 'newCategorie' )      //if new categorie btn was clicked
          {
            $(".formTitle").html('Nueva Categoría');
            $("#formCategorie").attr('action', '{{ url((($blog_admin == true)? "Admin_Blog" : "Blog" )."/categories/create") }}');
            $("#imgPreview").attr('src', '{{ url("img/imgTemas") }}/preview.png');
          }
          else      //else edit categorie was clicked
          {
            $(".formTitle").html('Editar Categoría');
            $("#formCategorie").attr('action', '{{ url((($blog_admin == true)? "Admin_Blog" : "Blog" )."/categories/update") }}')
            for(var x=0; x<catList.length; x++){
              if(catList[x]['id'] == $(this).attr('id') ){
                //set values on form
                $("#idHidden").val(catList[x]['id']);
                $("#descripcion").val(catList[x]['descripcion']);
                $("#foto").val(catList[x]['foto']);
                $("#imgPreview").attr('src', '{{ url("img/imgTemas") }}/'+catList[x]['foto']);
              }
            }
          }
          $(".transparencyBG, .hoverBlock").show();
        });

        //clean and close (hide) the categorie form
        $(".closeFormBtn").on('click', function(){
          $('#formCategorie')[0].reset();
          $(".transparencyBG, .hoverBlock").hide();
          $("#imgPreview").attr('src', '{{ url("img/imgTemas") }}/preview.png');
        });

        //------------------------------------------
        //            AJAX FUNCTIONS
        //------------------------------------------
        //upload file in one click
        $("#fileupload").uploadFile({
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

        //toogle categorie stat
        $(".toggleBtn").on('click', function(){
          var btn = $(this);
          var thisBlock =  $("#block"+$(this).attr('metaId'));

            $.ajax({
            data: { "_token": "{{ csrf_token() }}",
                    "id": $(this).attr('metaId'),
                    "stat": $(this).attr('metaStat')
                  },
            type: "POST",
            url: "{{ url((($blog_admin == true)? 'Admin_Blog' : 'Blog' ).'/categories/toggle') }}",
            beforeSend: function() {
              btn.html('<i class="fas fa-sync fa-spin"></i>')
            }
            })
            .done(function(data){
              if( data == 0 ){
                btn.html('Habilitar Categoría &nbsp; <i class="far fa-eye"></i>');
                thisBlock.css("opacity", "0.5");
              }else if( data == 1 ){
                btn.html('Deshabilitar Categoría &nbsp; <i class="fas fa-eye-slash"></i>');
                thisBlock.css("opacity", "1");
              }
              btn.attr('metaStat', data);
            })
            .fail(function(data){

            });

        });

      });
    </script>
  @endsection
