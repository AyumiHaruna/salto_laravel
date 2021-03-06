@extends('layouts.mainLayout')

  @section('title') Perfil @endsection

  @section('extraheader')
    <link rel="stylesheet" href="{{ asset('css/perfil/style.css') }}">

    <!--  upload File  -->
    <link href="{{ asset('css/uploadfile.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery.uploadfile.min.js') }}"></script>

    <!-- jquery ui -->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('js/vendor/jquery.datetimepicker.min.css') }}" / >
    <script src="{{ asset('js/vendor/jquery.datetimepicker.full.js') }}"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
  @endsection


  @section('content')
    <div class="transparentDiv"></div>

    <!-- div alerts -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4 offset-md-4 alert-div">
          - - -
        </div>
      </div>
    </div>

    <div class="col-md-4 offset-md-4 hiddenForm" id="div-photo">
      <div class="row">
        <div class="col-md-12 hiddenForm_header">
            Foto de perfíl
            <button type="button" name="button" class="btn closeBtn"><i class="far fa-times-circle fa-lg"></i></button>
        </div>
        <div id="upload-photo" class="col-md-12"></div>
      </div>
    </div>

    <div class="col-md-4 offset-md-4 hiddenForm" id="div-cv">
      <div class="row">
        <div class="col-md-12 hiddenForm_header">
            Curriculum Vitae
            <button type="button" name="button" class="btn closeBtn"><i class="far fa-times-circle fa-lg"></i></button>
        </div>
        <div id="upload-cv" class="col-md-12"></div>
      </div>
    </div>

    <!-- form-block -->
    <div class="container-fluid" style="background:url('{{ asset('img/web/saltum_back01.png') }}')">
      <div class="row">
        <div class="col-md-6 offset-md-3" id="mainContainer">
          <div class="row">
            <div class="col-md-12 text-center" id="title1">
              Datos
            </div>
            <div class="col-md-12 text-center" id="title2">
              {{ ((Session('role') == 3)? 'de Coach' : 'de Usuario' ) }}
            </div>
          </div>
        </div>

        <div class="col-md-12" id="formContainer">
          <div class="row">

            <div class="col-sm-12 formBlockLeft">
              <div class="canUpdate hasModal" id="photo">
                  <img src="{{ asset('files/usersFiles/'.(($user['photo'] == null)? 'avatarPreview.png' : $user['photo'] ) ) }}"  id="perfilPhoto">
                  Cambiar foto de perfil <i class="fas fa-pencil-alt fa-lg editIcon"></i>
              </div>
            </div>

            <div class="col-md-6 formBlockLeft">
              <div class="row">
                <div class="col-sm-12">
                  <div class="canUpdate" id="div-name">
                    <label for="name">Nombre(s):</label><i class="fas fa-pencil-alt fa-lg editIcon"></i>
                    <input type="text" class="form-control input-data" name="name" id="name" value="{{ $user['name'] }}">
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="canUpdate" id="div-last_name">
                    <label for="last_name">Apellido:</label><i class="fas fa-pencil-alt fa-lg editIcon"></i>
                    <input type="text" class="form-control input-data" name="last_name" id="last_name" value="{{ $user['last_name'] }}">
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="canUpdate" id="div-birthdate">
                    <label for="birthdate">Fecha de Nacimiento:</label><i class="fas fa-pencil-alt fa-lg editIcon"></i>
                    <input type="text" class="form-control input-data" name="birthdate" id="birthdate" value="{{ $user['birthdate'] }}">
                  </div>
                </div>

                <div class="col-sm-12">
                  <div id="div-email">
                    <label for="email">Correo Electrónico:</label>
                    <input type="text" class="form-control" name="ro-email" id="ro-email" value="{{ $user['email'] }}" readonly>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6 formBlockRight">
              <div class="row">
                @IF( Session('role') == 6 || Session('role') == 1)
                  <div class="col-sm-12">
                    <div id="div-company_id">
                      <label for="company_id">Empresa:</label>
                      <input type="text" class="form-control" name="ro-company_id" id="ro-company_id" value="{{ $company['display_name'] }}" readonly>
                    </div>
                  </div>
                @ENDIF

                @IF( Session('role') == 4 || Session('role') == 1)
                  <div class="col-sm-12">
                    <div class="canUpdate" id="div-description">
                      <label for="description">Descripción:</label><i class="fas fa-pencil-alt fa-lg editIcon"></i>
                      <textarea class="form-control input-data" name="description" id="description" rows="4" cols="50">{{ $user['description'] }}</textarea>
                    </div>
                  </div>

                <div class="col-md-12">
                  <div class="canUpdate" id="div-cv">
                    <label>Curriculum Vitae:</label> <a href="{{ url('files/usersFiles/'.$user['cv']) }}" id="span-cv" download>  Descargar </a>
                    <br> <button type="button" class="btn hasModal" id="cv">Cargar Curriculum &nbsp; <i class="far fa-file-alt"></i></button>
                  </div>
                </div>
                @ENDIF

              </div>
            </div>

            <div class="col-md-12 text-center">
              <label>Miembro desde:</label> <span id="span-created_at">{{ date_format($user['created_at'], 'd-M-Y') }}</span>
            </div>

          </div>
        </div>

      </div>
    </div>

    <!-- info-block -->





        </div>
    </div>
  @endsection

  @section('jqueryScripts')
    <script type="text/javascript">
      $(document).ready(function(){
        //------------------------------------------
        //                 VARS
        //-----------------------------------------
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

        //------------------------------------------
        //          INITIAL CONDITIONS
        //-----------------------------------------
        // config datepicker
        $('#birthdate').datetimepicker({
            timepicker:false,
            format: "Y-m-d"
        });

        //------------------------------------------
        //            DOM FUNCTIONS
        //------------------------------------------
        // show EditIcon on hover
        $(".canUpdate").hover(
          function(){
              $(this).children(".editIcon").show();
          }, function(){
              $(this).children(".editIcon").hide();
          }
        );

        // show update inputs
        $(".hasModal").on('click', function(){
          $("#div-"+$(this).attr('id')).show();
          $(".transparentDiv").show();
          // $(".ajax-file-upload").children('span').html('Seleccione');
          // $(".ajax-file-upload").css('background-color', 'red');
        });

        // hide update inputs
        $(".closeBtn, .transparentDiv").on('click', function(){
          $(".hiddenForm").hide();
          $(".transparentDiv").hide();
        });


        //------------------------------------------
        //            GENERAL FUNCTIONS
        //------------------------------------------
        //  show alerts
        function showAlert( type, message ) {
          if (type == 'ok'){
            $(".alert-div").html(message);
            $(".alert-div").show();
            setTimeout(function(){
              $(".alert-div").hide();
            }, 3500);
          } else if (type == 'error'){
            $(".alert-div").html(message);
            $(".alert-div").show();
            setTimeout(function(){
              $(".alert-div").hide();
            }, 3500);
          }
        }

        //
        //------------------------------------------
        //            AJAXFUNCTIONS
        //------------------------------------------
        // Ajax function to upload photo
        $("#upload-photo").uploadFile({
            url:"{{ url('/Perfil/upload') }}",
            fileName:"myfile",
            formData: {type: 'photo', id: {{ $user['id'] }} },
            multiple: false,
            allowedTypes: "jpg,jpeg,png,gif",
            onSuccess:function(files,data,xhr,pd){
              $(".ajax-file-upload-container").html('');
              $("#div-photo, .transparentDiv").hide();
              showAlert('ok', '<span style="color:#00cc00"> <i class="fas fa-check-circle fa-lg"></i> Se actualizó la foto exitosamente </span>');
              $("#perfilPhoto").attr("src", "{{ asset('files/usersFiles') }}/"+data);
            },
            error: function (e, data) {
              $(".ajax-file-upload-container").html('');
              showAlert('error', '<span style="color:#ff3300"> <i class="fas fa-exclamation-circle fa-lg"></i> Error, favor de reintentarlo </span>');
            }
        });

        // Ajax function to upload CV
        $("#upload-cv").uploadFile({
            url:"{{ url('/Perfil/upload') }}",
            fileName:"myfile",
            formData: {type: 'cv', id: {{ $user['id'] }} },
            multiple: false,
            onSuccess:function(files,data,xhr,pd){
              $(".ajax-file-upload-container").html('');
              $("#div-cv, .transparentDiv").hide();
              showAlert('ok', '<span style="color:#00cc00"> <i class="fas fa-check-circle fa-lg"></i> Se actualizó el curriculum vitae exitosamente </span>')
              $("#span-cv").attr("href", "{{ url('files/usersFiles') }}/"+data);
              $("#span-cv").html(data);

            },
            error: function (e, data) {
              $(".ajax-file-upload-container").html('');
              showAlert('error', '<span style="color:#ff3300"> <i class="fas fa-exclamation-circle fa-lg"></i> Error, favor de reintentarlo </span>');
            }
        });


        // Ajax function to update perfil info
        $(".input-data").change( function(){
          flag = $(this).attr('id');
          $.ajax({
          data: { "_token": "{{ csrf_token() }}",
                  "id": {{ $user['id'] }},
                  "flag": flag,
                  "value": $("#"+flag).val()
                },
          type: "POST",
          url: "{{ url('/Perfil/update') }}"
          })
          .done(function(data){
              showAlert( 'ok', '<span style="color:#00cc00"> <i class="fas fa-check-circle fa-lg"></i> Datos actualizados exitosamente </span>' );
          })
          .fail(function(data){
              showAlert('error', '<span style="color:#ff3300"> <i class="fas fa-exclamation-circle fa-lg"></i> Error, favor de reintentarlo </span>' );
          });
        });
      });
    </script>
  @endsection
