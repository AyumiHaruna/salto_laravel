@extends('layouts.mainLayout')


  @section('title') {{ $section->display_name }} @endsection

  @section('extraheader')
  	<link rel="stylesheet" href="{{env('PUBLIC_URL', 'http://localhost/public').'/css/users.css'}}">
    <link rel="stylesheet" href="{{env('PUBLIC_URL', 'http://localhost/public').'/css/material/material-design.min.css'}}">
  	<link rel="stylesheet" href="{{env('PUBLIC_URL', 'http://localhost/public').'/css/bootstrap/bootstrap-extend.min.css'}}">
  @endsection





  @section('content')
  <!-- Page -->
    <div id="main_container" class="row">

        <!-- Sidebar -->
        @include('admin.partials.sidebar')
        <!-- End Sidebar -->

        <!-- Main Content -->
        <div id="page-main" class="col-12 col-sm-12 col-md-8 col-lg-9 col-xl-10">
            <!-- Content Header -->
            <div class="page-header row">
                <h1 class="users_page-title col-6">Gestión de usuarios</h1>
                <div class="page-search-actions col-5">
                    <form action="{{env('PUBLIC_URL', 'http://localhost/public').'/'.$section->name.'/buscar/nombre'}}" method="GET">
                        <div class="input-search input-search-dark">
                            <i class="input-search-icon md-search" aria-hidden="true"></i>
                            <input id="search" type="text" class="form-control" placeholder="Búsqueda..." name="q" value="@if( isset($query) && !empty($query) ) {{ trim($query) }} @endif">
                            <button type="button" class="input-search-close icon md-close" aria-label="Close"></button>
                        </div>
                        <input type="submit" hidden="hidden">
                    </form>
                </div>
            </div>
            <!-- End Content Header -->

            <!-- Content -->
            <div id="page-content" class="page-content page-content-table">
                <table class="table is-indent tablesaw" data-tablesaw-mode="stack" data-plugin="animateList" data-animate="fade" data-child="tr" data-selectable="selectable">
                    <thead>
                        <tr>
                            <th class="pre-cell"></th>
                            <th class="cell-30" scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3">
                                <span class="checkbox-custom checkbox-primary checkbox-lg ">
                                    <input id="users-select-all" type="checkbox" class="contacts-checkbox selectable-all" id="select_all"/>
                                    <label for="select_all"></label>
                                </span>
                            </th>
                            <th class="cell-300" scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3" style="text-align: left;font-family:'AvenirLTStd-Light';font-size: 2vh;color: #AAAAAA !important">Nombre</th>
                            <th class="cell-300" scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5" style="text-align: left;font-family:'AvenirLTStd-Light';font-size: 2vh;color: #AAAAAA !important">Correo electrónico</th>
                            <th class="cell-300" scope="col" data-tablesaw-sortable-col data-tablesaw-priority="6" style="text-align: left;font-family:'AvenirLTStd-Light';font-size: 2vh;color: #AAAAAA !important">ID</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="7" style="text-align: left;font-family:'AvenirLTStd-Light';font-size: 2vh;color: #AAAAAA !important">Rol</th>
                            <th scope="col" data-tablesaw-sortable-col data-tablesaw-priority="8" style="text-align: left;font-family:'AvenirLTStd-Light';font-size: 2vh;color: #AAAAAA !important">Empresa</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if( isset($mainItem) )
                        @foreach($mainItem as $index => $user)
                        <tr>
                            <td class="pre-cell"></td>
                            <td class="cell-30">
                                <span class="checkbox-custom checkbox-primary checkbox-lg">
                                    <input type="checkbox" class="contacts-checkbox selectable-item checkbox-user" name="user" value="{{ $user['id'] }}" id="user_{{ $index }}"/>
                                    <label for="user_{{ $index }}"></label>
                                </span>
                            </td>
                            <td class="cell-300">
                                <a href="javascript:void(0)" data-uid="{{ $user['id'] }}" class="openEditUserModal tdfirstname" style="text-align: left;font-family:'AvenirLTStd-Light';font-size: 1.5vh;color: #10181F !important">{{ $user['name'].' '.$user['last_name'] }}</a>
                            </td>
                            <td class="cell-300 tdemail" style="text-align: left;font-family:'AvenirLTStd-Light';font-size: 1.5vh;color: #AAAAAA !important">{{ $user['email'] }}</td>
                            <td class="cell-300 tdusername" style="text-align: left;font-family:'AvenirLTStd-Light';font-size: 1.5vh;color: #AAAAAA !important">{{ $user['id'] }}</td>
                            <td class="cell-300" style="text-align: left;font-family:'AvenirLTStd-Light';font-size: 1.5vh;color: #AAAAAA !important">{{ $user['role_name'] }}</td>
                            <td class="cell-300" style="text-align: left;font-family:'AvenirLTStd-Light';font-size: 1.5vh;color: #AAAAAA !important">{{ $user['company_name'] }}</td>
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
            <!-- End Content -->

        </div>
        <!-- End Main Content -->

    </div>
    <!-- End Page -->

    <!-- Site Action -->
    <div class="site-action">
        <button id="addUser-button" type="button" class="btn-raised btn btn-floating" style="background-color: white;outline: none;border-color: transparent;color:#4262aa;">
            <i id="plus_icon" class="front-icon md-plus animation-scale-up" aria-hidden="true"></i>
            <i id="close_icon" class="back-icon md-close animation-scale-up" aria-hidden="true"></i>
        </button>
        <div id="garbage-button" class="site-action-buttons">
                <button type="button" data-action="trash" class="btn-raised btn btn-danger btn-floating animation-slide-bottom">
                <i class="icon md-delete" aria-hidden="true"></i>
            </button>
        </div>
    </div>
    <!-- End Site Action -->

    <!-- Add User Form -->
    <div class="modal modal-primary fade" id="addUserModal" aria-hidden="true" aria-labelledby="addUserModal"
         role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Crear Nuevo Usuario</h4>
                    <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                </div>

                @if (count($errors->userForm) > 0)
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <ul>
                        @foreach ($errors->userForm->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                {{--@include('common.errors')--}}
                <div class="modal-body">
                    <form id="addUserForm" method="POST" action="{{env('PUBLIC_URL', 'http://localhost/public').'/'.$section->name.'/crear'}}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <input type="text" class="form-control {{ ($errors->userForm->has('first_name')) ? 'focus' : '' }}" name="first_name" placeholder="Nombre" value="{{ old('first_name') }}" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control {{ ($errors->userForm->has('last_name')) ? 'focus' : '' }}" name="last_name" placeholder="Apellidos" value="{{ old('last_name') }}" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control {{ ($errors->userForm->has('email')) ? 'focus' : '' }}" name="email" placeholder="Correo Electrónico" value="{{ old('email') }}" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;"/>
                        </div>
                        <div class="form-group">
                            <input type="text" data-plugin="strength" class="form-control {{ ($errors->userForm->has('password')) ? 'focus' : '' }}" name="password" placeholder="Contraseña" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;"/>
                        </div>
                        <div class="form-group">
                            <select name="role" data-plugin="selectpicker" data-noneSelectedText="Ninguno">
                                @if(isset($secondItem))
                                    @foreach($secondItem as $index => $role)
                                        <option value="{{ $role->id }}" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;" >{{ $role->display_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="company" data-plugin="selectpicker" data-noneSelectedText="Ninguno">
                                @if(isset($companies))
                                    @foreach($companies as $index => $company)
                                        <option value="{{ $company->id }}" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;" >{{ $company->display_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" id="submitAddUserForm" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;background-color: #D49000
 !important; border-color: #D49000 !important">Guardar</button>
                    <a class="btn btn-sm btn-white btn-pure" data-dismiss="modal" href="javascript:void(0)" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;border-color: #AAAAAA !important; color: #AAAAAA !important">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add User Form -->

    <!-- Edit User Form -->
    <div class="modal modal-primary fade" id="editUserModal" aria-hidden="true" aria-labelledby="editUserModal"
         role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Usuario</h4>
                    <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                </div>

                @if (count($errors->editUserForm) > 0)
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <ul>
                            @foreach ($errors->editUserForm->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="editUserForm" method="post" action="{{env('PUBLIC_URL', 'http://localhost/public').'/'.$section->name.'/actualizar'}}">

                    <div class="modal-body">

                        {!! csrf_field() !!}

                        <div class="form-group">
                            <input id="formuid" type="hidden" class="form-control" name="uid" placeholder="" value="{{ old('uid') }}" />
                        </div>
                        <div class="form-group">
                            <input id="formfirstname" type="text" class="form-control {{ ($errors->editUserForm->has('first_name')) ? 'focus' : '' }}" name="first_name" placeholder="Nombre" value="{{ old('first_name') }}" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;"/>
                        </div>
                        <div class="form-group">
                            <input id="formlastname" type="text" class="form-control {{ ($errors->editUserForm->has('last_name')) ? 'focus' : '' }}" name="last_name" placeholder="Apellidos" value="{{ old('last_name') }}" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;"/>
                        </div>
                        <div class="form-group">
                            <input id="formemail" type="text" readonly class="form-control {{ ($errors->editUserForm->has('email')) ? 'focus' : '' }}" name="email" placeholder="Correo Electrónico" value="{{ old('email') }}" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;"/>
                        </div>
                        <!--<div class="form-group">
                            <input id="formpass" type="text" class="form-control" name="password" placeholder="Contraseña" data-plugin="strength" data-show-toggle="true"/>
                        </div>
                        <br><br>-->
                        <div class="form-group">
                            <select id="editselectrol" name="rol" data-plugin="selectpicker" data-noneSelectedText="Ninguno">
                                @if(isset($secondItem))
                                    @foreach($secondItem as $index => $role)
                                        <option value="{{ $role->id }}" class="edit_role_option" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;" @if(old('rol') == $role->id) selected @endif>{{ $role->display_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <select id="editselectcompany" name="company_edit" data-plugin="selectpicker" data-noneSelectedText="Ninguno">
                                @if(isset($companies))
                                    @foreach($companies as $index => $company)
                                        <option value="{{ $company->id }}" class="edit_company_option" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;" @if(old('company') == $company->id) selected @endif>{{ $company->display_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;background-color: #D49000
 !important; border-color: #D49000 !important">Actualizar</button>
                        <a class="btn btn-sm btn-white btn-pure" data-dismiss="modal" href="javascript:void(0)" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;border-color: #AAAAAA !important; color: #AAAAAA !important">Cancelar</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- End Edit User Form -->

    <!-- Add Label Form -->
    <div class="modal fade" id="addLabelForm" aria-hidden="true" aria-labelledby="addLabelForm"
         role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Add New Label</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <input type="text" class="form-control" name="lablename" placeholder="Label Name"
                            />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal" type="submit">Save</button>
                    <a class="btn btn-sm btn-white btn-pure" data-dismiss="modal" href="javascript:void(0)">Cancel</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add Label Form -->

  @endsection




@section('jqueryScripts')
<script>
    var route_users_destroy = "{{env('PUBLIC_URL', 'http://localhost/public').'/Usuarios/borrar'}}";
    var route_users_get_user = "{{env('PUBLIC_URL', 'http://localhost/public').'/Usuarios/buscar/id'}}";
    var token = '{{ csrf_token() }}';

</script>
<script src="{{ asset('js/mainFunctions.js') }}"></script>
<script src="{{ asset('js/users.js') }}"></script>
<script>
    if({{count($errors->editUserForm)}} > 0){
        $('#editUserModal').modal('show');
    }
    if({{count($errors->userForm)}} > 0){
        $('#addUserModal').modal('show');
    }
</script>
@endsection
