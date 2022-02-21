@extends('layouts.mainLayout')

  <!--    HEAD      -->
  @section('title') Recursos @endsection

  @section('extraheader')
    <link rel="stylesheet" href="{{ asset('css/resources/style.css') }}">

    <!--  upload File  -->
    <link href="http://hayageek.github.io/jQuery-Upload-File/4.0.11/uploadfile.css" rel="stylesheet">
    <script src="http://hayageek.github.io/jQuery-Upload-File/4.0.11/jquery.uploadfile.min.js"></script>

    <!-- jquery ui -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
  @endsection

  @section('content')

    <!-- transparency background -->
    <div class="col-md-12 transparencyBG"></div>

    <!-- new resource form -->
    <div class="col-md-12 hoverBlock">
      <div class="row">
        <div class="col-md-6 offset-md-3 hoverForm">
          <form name="formResource" id="formResource" action="{{ url('/Admin_Recursos/store') }}" method="post" enctype="multipart/form-data">
            {!! csrf_field() !!}

            <div class="row"  id="block_form_header">
              <div class="col-md-12 formTitle">
                Nuevo Recurso
              </div>
              <button type="button" class="closeFormBtn"> <i class="far fa-times-circle"></i> </button>
            </div>

            <div class="row" id="block_form_body">
              <input type="hidden" name="id" id="idHidden">
              <div class="col-md-12 formBlock">
                <label for="descripcion">Descripción:</label>
                <input type="text" name="descripcion" id="descripcion" class="form-control" required>
              </div>

              <div class="col-md-6">
                <div class="row">
                  <div class="col-md-12">
                    <label for="url">Archivo:</label>
                    <input type="text" name="url" id="url" class="form-control" placeholder="Seleccione un archivo" readonly required><br>
                  </div>
                  <div id="fileupload" class="col-md-12">

                  </div>
                </div>
              </div>

              <div class="col-md-6 text-center formBlock filePreview">
                <i class="far fa-file-alt fa-4x grayfont"></i>
              </div>
            </div>

            <div class="row" id="block_form_footer">
              <div class="col-md-12 text-center">
                <button type="submit" class="btn" id="sendBtn">Guardar</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>

    <!-- list of Resources -->
    <div class="container-fluid" id="mainContainer" style="background-image: url('{{ asset('img/web/saltum_back01.png') }}');">
      <div class="row">
        <div class="col-md-12 text-center" id="title1">
          Recursos
        </div>

        <div class="col-md-6 leftBlock">
          <div class="row">
            <div class="col-md-12" id="blockMsg">
              Recordando los 5 pilares que forman nuestra
              práctica (autocuidado, autonomía, creatividad,
              empatía y positivismo), dejamos a tu disposición
              estos recursos para que estemos en constante
              trabajo y mejora de nuestra vida personal y con
              nuestros clientes:
            </div>
          </div>
        </div>
        <div class="col-md-6 rightBlock">
          <div class="row" id="blockResource">
            <div class="col-sm-4">
              <img src="{{ asset('img/web/pdficon.png') }}" alt="" id="pdficon">
            </div>
            <div class="col-sm-6">
              @FOREACH($resources as $resource)
                <div class="row">
                  <div class="col-md-12" id="div-{{ $resource->id }}">
                    <a href="{{ url('files/'.$resource->url) }}" class="downloadBtn" metaId="{{ $resource->id }}" download> {{ $resource->descripcion }} </a>

                      @IF( $resource_admin == true )
                      <br>
                      <button type="button" name="button" class="btn editResourceBtn" metaId="{{ $resource->id }}"> <i class="fas fa-pencil-alt fa-lg"></i> </button>
                      <button type="button" name="button" class="btn delResourceBtn" metaId="{{ $resource->id }}"> <i class="far fa-trash-alt fa-lg"></i> </button>
                      @ENDIF

                  </div>
                </div>
              @ENDFOREACH
            </div>
          </div>

          @IF( $resource_admin == true  )
            <div class="col-md-12 text-center">
              <button type="button" name="button" class="btn" id="newResourceBtn">Nuevo Recurso</button>
            </div>
          @ENDIF
        </div>












      @IF(false)
      <div class="col-md-12 sectionTitle">
        @IF(session('success'))
            <span style="color:green">{{session('success')}}</span>
        @ENDIF
      </div>

        <div class="row">
          @FOREACH($resources as $resource)
            <div class="col-md-12" id="div-{{ $resource->id }}">
              {{ date('Y-M-d', strtotime($resource->created_at)) }} -
              {{ $resource->descripcion }},
              <a href="{{ url('files/'.$resource->url) }}" class="downloadBtn" metaId="{{ $resource->id }}" download> Descargar </a>,
              <span id="dwnId-{{ $resource->id }}"> Descargado "{{ $resource->downloads }}" veces. </span>
              @IF( $resource_admin == true )
              <button type="button" name="button" class="btn editResourceBtn" metaId="{{ $resource->id }}"> <i class="fas fa-pencil-alt fa-lg"></i> </button>
              &nbsp;&nbsp;
              <button type="button" name="button" class="btn delResourceBtn" metaId="{{ $resource->id }}"> <i class="far fa-trash-alt fa-lg"></i> </button>
              @ENDIF
            </div>
          @ENDFOREACH
          <input type="hidden" name="resSelected" id="resSelected" value="">
        </div>
        {{ $resources->links() }}
      @ENDIF


    </div>
  </div>

  @endsection


  @section('jqueryScripts')
    <script type="text/javascript">
      $(document).ready(function(){
        //------------------------------------------
        //            GENERAL VARS
        //------------------------------------------
        var resList = {!! json_encode($resources) !!};
        resList = resList['data'];
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        //------------------------------------------
        //            DOM FUNCTIONS
        //------------------------------------------
        //show the edit menu
        $("#newResourceBtn, .editResourceBtn").on('click', function(){
          if( $(this).attr("id") == 'newResourceBtn' )      //if new categorie btn was clicked
          {
            $(".formTitle").html('Nuevo Recurso');
            $("#formResource").attr('action', '{{ url("Admin_Recursos/store") }}');
            $(".filePreview").html('<i class="far fa-file-alt fa-4x grayfont"></i>');
          }
          else      //else edit categorie was clicked
          {
            $(".formTitle").html('Editar recurso');
            $("#formResource").attr('action', '{{ url("Admin_Recursos/update") }}');
            for(var x=0; x<resList.length; x++){
              if(resList[x]['id'] == $(this).attr('metaId') ){
                //set values on form
                $("#idHidden").val(resList[x]['id']);
                $("#descripcion").val(resList[x]['descripcion']);
                $("#url").val(resList[x]['url']);
              }
            }
          }
          $(".transparencyBG, .hoverBlock").show();
        });

        //clean and close (hide) the categorie form
        $(".closeFormBtn").on('click', function(){
          $('#formResource')[0].reset();
          $(".transparencyBG, .hoverBlock").hide();
          $(".filePreview").html('<i class="far fa-file-alt fa-4x grayfont"></i>');
        });

        //set the selected resource id, on resSelected hidden input and ask if delete
        $(".delResourceBtn").on('click', function(){
          $("#resSelected").val( $(this).attr("metaId") );
          var r = confirm("¿Deseas eliminar éste recurso?");
          if (r == true) {
              ajaxDelResource();
          } else {
            $("#resSelected").val('');
          }
        });

        //------------------------------------------
        //            AJAX FUNCTIONS
        //------------------------------------------
        //upload file in one click
        $("#fileupload").uploadFile({
            url:"{{ url('Admin_Recursos/resPostFile') }}",
            fileName:"myfile",
            multiple: false,
            // allowedTypes: "jpg,jpeg,png,gif",
            onSuccess:function(files,data,xhr,pd){
              if(data != 'error'){
                $("#url").val(data);
                $("#fileupload, .ajax-file-upload-container").hide();
                $(".filePreview").html('<i class="far fa-file-alt fa-4x blackfont"></i>&nbsp;<i class="fas fa-check fa-2x greenFont"></i>');
              } else {
                $(".filePreview").html('<i class="far fa-file-alt fa-4x grayfont"></i>&nbsp;<i class="fas fa-times fa-2x redFont"></i>');
              }
            }
        });

        //delete a resource
        function ajaxDelResource()
        {
          $.ajax({
          data: { "_token": "{{ csrf_token() }}",
                  "id": $("#resSelected").val()
                },
          type: "POST",
          url: "{{ url('Admin_Recursos/delete') }}",
          beforeSend: function() {
            // btn.html('<i class="fas fa-sync fa-spin"></i>')
          }
          })
          .done(function(data){
            $("#div-"+data).detach();
          })
          .fail(function(data){
            console.log('ajaxDelResource(Error)');
          });
        }

        //Ajax Downloads + 1
        $(".downloadBtn").on('click', function(){
          var id = $(this).attr('metaId');
          $.ajax({
            data: { "_token": "{{ csrf_token() }}",
                    id
                  },
            type: "POST",
            url: "{{ url('Admin_Recursos/resDownPlus') }}",
          })
          .done(function(data){
            $("#dwnId-"+id).html('Descargado "'+data+'" veces.')
          })
          .fail(function(data){
            console.log('downPlusOne(Error)');
          });
        });
      });
    </script>
  @endsection
