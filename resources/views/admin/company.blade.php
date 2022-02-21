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
                <h1 class="main_page-title col-6">Gestión de Empresas</h1>
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
                        </tr>
                    </thead>
                    <tbody>
                    @if( isset($mainItem) )
                        @foreach($mainItem as $index => $company)
                        <tr>
                            <td class="cell-30">
                                <span class="checkbox-custom checkbox-primary checkbox-lg">
                                    <input type="checkbox" class="contacts-checkbox selectable-item checkbox-object" name="object" value="{{ $company['id'] }}" id="company_{{ $index }}"/>
                                    <label for="company_{{ $index }}"></label>
                                </span>
                            </td>
                            <td class="cell-300">
                                <a href="javascript:void(0)" data-uid="{{ $company['id'] }}" class="openEditCompanyModal tdfirstname" style="text-align: left;font-family:'AvenirLTStd-Light';font-size: 1.5vh;color: #10181F !important">{{ $company['name'] }}</a>
                            </td>
                            <td class="cell-300 td_name" style="text-align: left;font-family:'AvenirLTStd-Light';font-size: 1.5vh;color: #AAAAAA !important">{{ $company['display_name'] }}</td>
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
        <button id="addCompany-button" type="button" class="btn-raised btn btn-floating" style="background-color: white;outline: none;border-color: transparent;color:#4262aa;">
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

    <!-- Add Company Form -->
    <div class="modal modal-primary fade" id="addCompanyModal" aria-hidden="true" aria-labelledby="addCompanyModal"
         role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Crear Nueva Empresa</h4>
                    <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                </div>

                @if (count($errors->companyForm) > 0)
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <ul>
                        @foreach ($errors->companyForm->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif
                {{--@include('common.errors')--}}
                <div class="modal-body">
                    <form id="addCompanyForm" method="POST" action="{{env('PUBLIC_URL', 'http://localhost/public').'/'.$section->name.'/crear'}}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <input type="text" class="form-control {{ ($errors->companyForm->has('name')) ? 'focus' : '' }}" name="name" placeholder="Nombre corto" value="{{ old('name') }}" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;"/>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control {{ ($errors->companyForm->has('display_name')) ? 'focus' : '' }}" name="display_name" placeholder="Nombre largo" value="{{ old('display_name') }}" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;"/>
                        </div>        
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" id="submitAddCompanyForm" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;background-color: #D49000
 !important; border-color: #D49000 !important">Guardar</button>
                    <a class="btn btn-sm btn-white btn-pure" data-dismiss="modal" href="javascript:void(0)" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;border-color: #AAAAAA !important; color: #AAAAAA !important">Cancelar</a>
                </div>
            </div>
        </div>
    </div>
    <!-- End Add Company Form -->

    <!-- Edit Company Form -->
    <div class="modal modal-primary fade" id="editCompanyModal" aria-hidden="true" aria-labelledby="editCompanyModal"
         role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Permiso</h4>
                    <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                </div>

                @if (count($errors->editCompanyForm) > 0)
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <ul>
                            @foreach ($errors->editCompanyForm->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="editCompanyForm" method="post" action="{{env('PUBLIC_URL', 'http://localhost/public').'/'.$section->name.'/actualizar'}}">

                    <div class="modal-body">
                        
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <input id="formuid" type="hidden" class="form-control" name="uid" placeholder="" value="{{ old('uid') }}" />
                        </div>
                        <div class="form-group">
                            <input id="formName" type="text" class="form-control {{ ($errors->editCompanyForm->has('name')) ? 'focus' : '' }}" name="name" placeholder="Nombre" value="{{ old('name') }}" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;"/>
                        </div>
                        <div class="form-group">
                            <input id="formDisplayName" type="text" class="form-control {{ ($errors->editCompanyForm->has('last_name')) ? 'focus' : '' }}" name="display_name" placeholder="Nombre Largo" value="{{ old('display_name') }}" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;"/>
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
    <!-- End Edit Company Form -->


  @endsection




@section('jqueryScripts')
<script>
    var route_company_destroy = "{{env('PUBLIC_URL', 'http://localhost/public').'/Empresa/borrar'}}";
    var route_company_get_permiso = "{{env('PUBLIC_URL', 'http://localhost/public').'/Empresa/buscar/id'}}";
    var token = '{{ csrf_token() }}';

</script>
<script src="{{ asset('js/jquery.multi-select.js') }}"></script>
<script src="{{ asset('js/mainFunctions.js') }}"></script>
<script src="{{ asset('js/company.js') }}"></script>
<script> 
    if({{count($errors->editCompanyForm)}} > 0){
        $('#editCompanyModal').modal('show');
    } 
    if({{count($errors->companyForm)}} > 0){
        $('#addCompanyModal').modal('show');
    } 
</script>
@endsection