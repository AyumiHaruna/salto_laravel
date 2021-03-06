@extends('layouts.mainLayout')


  @section('title') {{ $section->display_name }} @endsection

  @section('extraheader')
  	<link rel="stylesheet" href="{{env('PUBLIC_URL', 'http://localhost/public').'/css/roles.css'}}">
    <link rel="stylesheet" href="{{env('PUBLIC_URL', 'http://localhost/public').'/css/multi-select.css'}}">
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
                <h1 class="main_page-title col-6">Gestión de roles</h1>
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
                     
                            <th class="cell-30" scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3">
                                <span class="checkbox-custom checkbox-primary checkbox-lg ">
                                    <input id="main-select-all" type="checkbox" class="contacts-checkbox selectable-all" id="select_all"/>
                                    <label for="select_all"></label>
                                </span>
                            </th>
                            <th class="cell-300" scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3" style="text-align: left;font-family:'AvenirLTStd-Light';font-size: 2vh;color: #AAAAAA !important">Nombre</th>
                            <th class="cell-300" scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5" style="text-align: left;font-family:'AvenirLTStd-Light';font-size: 2vh;color: #AAAAAA !important">Nombre Largo</th>
                            <th class="cell-300" scope="col" data-tablesaw-sortable-col data-tablesaw-priority="6" style="text-align: left;font-family:'AvenirLTStd-Light';font-size: 2vh;color: #AAAAAA !important">Descripción</th>
                            <th class="cell-300" scope="col" data-tablesaw-sortable-col data-tablesaw-priority="6" style="text-align: left;font-family:'AvenirLTStd-Light';font-size: 2vh;color: #AAAAAA !important">Permisos</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if( isset($mainItem) )
                        @foreach($mainItem as $index => $role)
                        <tr>
                            <td class="cell-30">
                                <span class="checkbox-custom checkbox-primary checkbox-lg">
                                    <input type="checkbox" class="contacts-checkbox selectable-item checkbox-object" name="object" value="{{ $role['id'] }}" id="role_{{ $index }}"/>
                                    <label for="role_{{ $index }}"></label>
                                </span>
                            </td>
                            <td class="cell-300">
                                <a href="javascript:void(0)" data-uid="{{ $role['id'] }}" class="openEditRoleModal tdfirstname" style="text-align: left;font-family:'AvenirLTStd-Light';font-size: 1.5vh;color: #10181F !important">{{ $role['name'] }}</a>
                            </td>
                            <td class="cell-300 td_name" style="text-align: left;font-family:'AvenirLTStd-Light';font-size: 1.5vh;color: #AAAAAA !important">{{ $role['display_name'] }}</td>
                            <td class="cell-300" style="text-align: left;font-family:'AvenirLTStd-Light';font-size: 1.5vh;color: #AAAAAA !important">{{ $role['description'] }}</td>
                            <td class="cell-300" style="text-align: left;font-family:'AvenirLTStd-Light';font-size: 1.5vh;color: #AAAAAA !important">
                                <select name="role" data-plugin="selectpicker" data-noneSelectedText="Ninguno">
                                    <option value="" selected>Permisos</option>
                                @if(isset($role['permissions']))
                                    @foreach($role['permissions'] as $index => $permission)
                                        <option value="{{ $permission->id }}" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;" disabled>{{ $permission->display_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            </td>
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
        <button id="addRole-button" type="button" class="btn-raised btn btn-floating" style="background-color: white;outline: none;border-color: transparent;color:#4262aa;">
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

    <!-- Add Role Form -->
    <div class="modal modal-primary fade" id="addRoleModal" aria-hidden="true" aria-labelledby="addRoleModal"
         role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Crear Nuevo Rol</h4>
                    <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                </div>

                @if (count($errors->roleForm) > 0)
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <ul>
                        @foreach ($errors->roleForm->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                {{--@include('common.errors')--}}
                <div class="modal-body">
                    <form id="addRoleForm" method="POST" action="{{env('PUBLIC_URL', 'http://localhost/public').'/'.$section->name.'/crear'}}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <input type="text" class="form-control {{ ($errors->roleForm->has('name')) ? 'focus' : '' }}" name="name" placeholder="Nombre corto" value="{{ old('name') }}" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control {{ ($errors->roleForm->has('display_name')) ? 'focus' : '' }}" name="display_name" placeholder="Nombre largo" value="{{ old('display_name') }}" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;"/>
                        </div>
                        <div class="form-group">
                            <textarea type="text" class="form-control {{ ($errors->roleForm->has('description')) ? 'focus' : '' }}" name="description" placeholder="Descripción" cols="40" rows="5" value="{{ old('description') }}" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;"></textarea>
                        </div>  
                        @IF( count($secondItem) == 0 )
                            No existe ninguna categoría

                        @ELSE
                        <select class="form-control" name="permissions[]" id='permissions' multiple='multiple' required>
                            @FOR($x = 0; $x < count($secondItem); $x++)
                                <option value="{{ $secondItem[$x]->id }}"> {{ $secondItem[$x]->display_name }} </option>
                            @ENDFOR
                        </select>
                        @ENDIF                      
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" id="submitAddRoleForm" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;background-color: #D49000
 !important; border-color: #D49000 !important">Guardar</button>
                    <a class="btn btn-sm btn-white btn-pure" data-dismiss="modal" href="javascript:void(0)" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;border-color: #AAAAAA !important; color: #AAAAAA !important">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add Role Form -->

    <!-- Edit Role Form -->
    <div class="modal modal-primary fade" id="editRoleModal" aria-hidden="true" aria-labelledby="editRoleModal"
         role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Rol</h4>
                    <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                </div>

                @if (count($errors->editRoleForm) > 0)
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <ul>
                            @foreach ($errors->editRoleForm->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="editRoleForm" method="post" action="{{env('PUBLIC_URL', 'http://localhost/public').'/'.$section->name.'/actualizar'}}">

                    <div class="modal-body">
                        
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <input id="formuid" type="hidden" class="form-control" name="uid" placeholder="" value="{{ old('uid') }}" />
                        </div>
                        <div class="form-group">
                            <input id="formName" type="text" class="form-control {{ ($errors->editRoleForm->has('name')) ? 'focus' : '' }}" name="name" placeholder="Nombre" value="{{ old('name') }}" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;"/>
                        </div>
                        <div class="form-group">
                            <input id="formDisplayName" type="text" class="form-control {{ ($errors->editRoleForm->has('last_name')) ? 'focus' : '' }}" name="display_name" placeholder="Nombre Largo" value="{{ old('display_name') }}" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;"/>
                        </div>
                        <div class="form-group">
                            <textarea id="formDescription" type="text" class="form-control {{ ($errors->roleForm->has('description')) ? 'focus' : '' }}" name="description" placeholder="Descripción" cols="40" rows="5" value="{{ old('description') }}" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;"></textarea>
                        </div>  
                        <select class="form-control" name="permissions[]" id='permissions_edit' multiple='multiple' required>
                            @FOR($x = 0; $x < count($secondItem); $x++)
                                <option class="edit_permission_option" value="{{ $secondItem[$x]->id }}"> {{ $secondItem[$x]->display_name  }} </option>
                            @ENDFOR
                        </select>
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
    <!-- End Edit Role Form -->

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
    var route_roles_destroy = "{{env('PUBLIC_URL', 'http://localhost/public').'/Roles/borrar'}}";
    var route_roles_get_role = "{{env('PUBLIC_URL', 'http://localhost/public').'/Roles/buscar/id'}}";
    var token = '{{ csrf_token() }}';

</script>
<script src="{{ asset('js/jquery.multi-select.js') }}"></script>
<script src="{{ asset('js/mainFunctions.js') }}"></script>
<script src="{{ asset('js/roles.js') }}"></script>
<script> 
    if({{count($errors->editRoleForm)}} > 0){
        $('#editRoleModal').modal('show');
    } 
    if({{count($errors->roleForm)}} > 0){
        $('#addRoleModal').modal('show');
    } 
</script>
@endsection