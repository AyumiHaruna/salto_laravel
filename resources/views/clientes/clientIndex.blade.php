@extends('layouts.mainLayout')

  @section('title') Clientes @endsection


  @section('extraheader')
    <link rel="stylesheet" href="{{ asset('css/client/client.css') }}">
  @endsection


  @section('content')
    <div class="container-fluid mainContainer" style="background-image: url('{{ asset('img/web/saltum_back01.png') }}');">
      <div class="row">

        <!-- div alerts -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-4 offset-md-4 alert-div">
              - - -
            </div>
          </div>
        </div>

        <div class="col-md-6 offset-md-3 titleContainer">
          <div class="row">
            <div class="col-md-12 text-center" id="title1">
              Mis
            </div>
            <div class="col-md-12 text-center" id="title2">
              Clientes
            </div>
          </div>
        </div>

        @IF(count($clientList) > 0)
          @FOREACH( $clientList AS $key => $client)
            <div class="col-sm-8 offset-sm-2 btnBlock" data-toggle="collapse" data-target="#collapse-{{ $client['id']}}" aria-expanded="false" aria-controls="collapse-{{ $client['id']}}">
              <div class="row subBtnBlock">
                <div class="col-sm-3 text-center infoPic">
                  <img src="{{ asset('img/web/folder_coach.png') }}" alt="">
                </div>
                <div class="col-sm-9 infoName">
                  {{$client['full_name']}}
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12 collapse infoContainer" id="collapse-{{ $client['id']}}">
                    <div class="row">
                      <div class="col-sm-4 text-center">
                        <img src="{{ (( $client['photo'] != null )? asset('files/usersFiles/'.$client['photo']) : asset('files/usersFiles/avatarPreview.png') ) }}" alt="foto" class="avatar">
                      </div>
                      <div class="col-sm-4" style="margin-top:50px;">
                        <label># Sesiones: </label> &nbsp; {{ $client['noSesiones'] }}
                      </div>
                      <div class="col-sm-4" style="margin-top:50px;">
                        <label>Edad: </label> &nbsp; {{ (($client['age'] != 0)? $client['age'].' a??os' : 'S/D') }}
                      </div>
                    </div>

                    <div class="row" style="margin-top: 15px;">
                      <div class="col-sm-4">
                        <label>Correo: </label> <br> {{ $client['mail'] }}
                      </div>
                      <div class="col-sm-8">
                        <label>Visi??n:</label> <br> {{ $client['vision'] }}
                      </div>
                    </div>

                    <div class="row goalsContainer">
                      <div class="col-sm-12">
                        <label>Metas</label>
                      </div>

                      <div class="table-responsive">
                        <table class="table goalTable">
                          <thead>
                            <tr class="text-center">
                              <th>Fecha de creaci??n</th>
                              <th>Tipo de meta</th>
                              <th>Descripci??n</th>
                              <th>Completada</th>
                            </tr>
                          </thead>
                          <tbody>
                            @IF( count($client['goals']) > 0 )
                              @FOREACH($client['goals'] as $goal)
                                <tr>
                                  <td class="text-center">{{$goal->date}}</td>
                                  <td class="text-center">{{ (($goal->type == 0)? 'Trimestral' : 'Semanal' ) }}</td>
                                  <td>{{$goal->description}}</td>
                                  <td class="text-center">{!! (($goal->completed == 0)? '<i class="fas fa-thumbs-up fa-rotate-180"></i>' : '<i class="far fa-thumbs-up"></i>') !!}</td>
                                </tr>
                              @ENDFOREACH
                            @ELSE
                              <tr>
                                <td colspan="4">El cliente a??n no ha creado metas</td>
                              </tr>
                            @ENDIF
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <div class="row formContainer">
                      <div class="col-sm-6">
                        <label for"perfilCliente">Perfil de mi cliente:</label>
                        <textarea name="name" class="form-control perfil-field" id="perfilCliente-{{ $client['id'] }}" rows="8" cols="80"> {{ $client['perfilCliente'] }} </textarea>
                        <button type="button" name="button" class="save" data-field="perfilCliente" data-id="{{ $client['id'] }}"><i class="far fa-save fa-lg"></i></button>
                      </div>
                      <div class="col-sm-6">
                        <label for="seguimientoCliente">Seguimiento de mi cliente:</label>
                        <textarea name="name" class="form-control seguimiento-field" id="seguimientoCliente-{{ $client['id'] }}" rows="8" cols="80"> {{ $client['seguimientoCliente'] }} </textarea>
                        <button type="button" name="button" class="save" data-field="seguimientoCliente" data-id="{{ $client['id'] }}"><i class="far fa-save fa-lg"></i></button>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          @ENDFOREACH
        @ELSE
          <div class="col-sm-8 offset-md-2 text-center infoBlock infoName">
                A??n no has tenido sesiones con algun cliente.
          </div>
        @ENDIF

      </div>
    </div>
  @endsection


  @section('jqueryScripts')
    <script type="text/javascript">
      $(document).ready(function() {
        $(".mainContainer .collapse").click(function(e){
          e.stopPropagation();
        });

        $(".save").click(function(){
          update( $(this).attr('data-field'), $(this).attr('data-id') );
        });

        function update(type, coachee_id){
              if( $('#'+type+'-'+coachee_id).val() == '' || $('#'+type+'-'+coachee_id).val() == null){
                var val = ''
              } else {
                var val =  $('#'+type+'-'+coachee_id).val();
              }

              $.ajax({
              data: { "_token": "{{ csrf_token() }}",
                      type,
                      coach_id: '{{ Session('user')->id }}',
                      coachee_id,
                      val
                    },
              type: "POST",
              url: "{{ url('Clientes/update') }}"
              }).done(function(data){
                  showAlert( 'ok', '<span style="color:#00cc00"> <i class="fas fa-check-circle fa-lg"></i> Datos actualizados exitosamente </span>' );
              }).fail(function(){
                  showAlert('error', '<span style="color:#ff3300"> <i class="fas fa-exclamation-circle fa-lg"></i> Error, favor de reintentarlo </span>' );
              });
          }

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
      });
    </script>
  @endsection
