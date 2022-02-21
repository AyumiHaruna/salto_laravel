@extends('layouts.mainLayoutSession')


  @section('title') {{ $section->display_name }} @endsection

  @section('extraheader')
  	<link rel="stylesheet" href="{{env('PUBLIC_URL', 'http://localhost/public').'/css/billing.css'}}">
    <link rel="stylesheet" href="{{env('PUBLIC_URL', 'http://localhost/public').'/css/multi-select.css'}}">
    <link rel="stylesheet" href="{{env('PUBLIC_URL', 'http://localhost/public').'/css/material/material-design.min.css'}}">
  	<link rel="stylesheet" href="{{env('PUBLIC_URL', 'http://localhost/public').'/css/bootstrap/bootstrap-extend.min.css'}}">
    <link rel="stylesheet" href="{{env('PUBLIC_URL', 'http://localhost/public').'/js/DataTables/datatables.css'}}">
  @endsection

 
  @section('in_page_title')
  <div class="header_title_text">
  COBRANZA
    </div>
    <div class="search_container">
    <div class="page-search-actions col-3">
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
  @endsection


  @section('content')
  <!-- Page -->
    <div id="main_container" class="row">

        <!-- Main Content -->
        <div id="page-main" class="col-12">

            <!-- Content -->
            <div id="page-content" class="page-content page-content-table">
                <table id="table" class="table is-indent tablesaw" data-tablesaw-mode="stack" data-plugin="animateList" data-animate="fade" data-child="tr" data-selectable="selectable">
                    <thead>
                        <tr class="header_father" bgcolor="#FF0000">
                            <th class="cell-300 table_header first selected" scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3" >Fecha</th>
                            <th class="cell-300 table_header" scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5" >Ingreso</th>
                            <th class="cell-400 table_header" scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5" >Plan contratado</th>
                            <th class="cell-600 table_header last" scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5" >Nuevo ingreso o recompra</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if( isset($mainItem) )
                        @foreach($mainItem as $index => $payment)
                        <tr>
                            <td class="cell-300 td_name" >{{ $payment['payment_datetime'] }}</td>
                            </td>
                            <td class="cell-300 td_name" >{{ $payment['amount'] }}</td>
                            </td>
                            <td class="cell-400 td_name" >{{ $payment['plan'] }}</td>
                            </td>
                            <td class="cell-600 td_name" >{{ $payment['first_payment'] }}</td>
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

    <!-- Site Action
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

  


  @endsection




@section('jqueryScripts')
<script>
    var route_company_destroy = "{{env('PUBLIC_URL', 'http://localhost/public').'/Empresa/borrar'}}";
    var route_company_get_permiso = "{{env('PUBLIC_URL', 'http://localhost/public').'/Empresa/buscar/id'}}";
    var token = '{{ csrf_token() }}';

</script>
<script src="{{ asset('js/jquery.multi-select.js') }}"></script>
<script src="{{ asset('js/mainFunctions.js') }}"></script>
<script src="{{ asset('js/billing.js') }}"></script>
<script src="{{ asset('/js/DataTables/datatables.js') }}"></script>
<script> 
    if({{count($errors->editCompanyForm)}} > 0){
        $('#editCompanyModal').modal('show');
    } 
    if({{count($errors->companyForm)}} > 0){
        $('#addCompanyModal').modal('show');
    } 

    $(document).ready( function () {
        $('#table').DataTable({
            searching: false
        });
    } );
</script>
@endsection