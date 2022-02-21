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
  FACTURACIÓN
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
        <div id="page-main" class="col-md-10 col-sm-12">

            <!-- Content -->
            <div id="page-content" class="page-content page-content-table">
                <table id="table" class="table is-indent tablesaw" data-tablesaw-mode="stack" data-plugin="animateList" data-animate="fade" data-child="tr" data-selectable="selectable">
                    <thead>
                        <tr class="header_father" bgcolor="#FF0000">
                            <th class="cell-300 table_header first selected" scope="col" data-tablesaw-sortable-col data-tablesaw-priority="3" >Fecha de compra</th>
                            <th class="cell-300 table_header" scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5" >Razón Social</th>
                            <th class="cell-400 table_header" scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5" >RFC</th>
                            <th class="cell-400 table_header" scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5" >Monto</th>
                            <th class="cell-600 table_header last" scope="col" data-tablesaw-sortable-col data-tablesaw-priority="5" >Mail</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if( isset($mainItem) )
                        @foreach($mainItem as $index => $invoice)
                        <tr>
                            <td class="cell-300 td_name" >{{ $invoice['payment_datetime'] }}</td>
                            </td>
                            <td class="cell-300 td_name" >{{ $invoice['invoice_name'] }}</td>
                            </td>
                            <td class="cell-400 td_name" >{{ $invoice['invoice_rfc'] }}</td>
                            </td>
                            <td class="cell-600 td_name" >${{ $invoice['amount'] }}</td>
                            </td>
                            <td class="cell-600 td_name" >{{ $invoice['invoice_email'] }}</td>
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

        <!-- Site Action -->
        <div class="site-action col-md-2 col-sm-12">
            <img class="col-md-12 col-sm-6 button" src="{{asset('img/web/admin_elements/boton_excel.png')}}" />
        </div>
        <!-- End Site Action -->

    </div>
    <!-- End Page -->

    



  @endsection




@section('jqueryScripts')
<script>
    var route_permisos_destroy = "{{env('PUBLIC_URL', 'http://localhost/public').'/Permisos/borrar'}}";
    var route_permisos_get_permiso = "{{env('PUBLIC_URL', 'http://localhost/public').'/Permisos/buscar/id'}}";
    var token = '{{ csrf_token() }}';

</script>
<script src="{{ asset('js/jquery.multi-select.js') }}"></script>
<script src="{{ asset('js/mainFunctions.js') }}"></script>
<script src="{{ asset('js/billing.js') }}"></script>
<script src="{{ asset('/js/DataTables/datatables.js') }}"></script>
<script> 
    if({{count($errors->editPermissionForm)}} > 0){
        $('#editPermissionModal').modal('show');
    } 
    if({{count($errors->permissionForm)}} > 0){
        $('#addPermissionModal').modal('show');
    } 
    $(document).ready( function () {
        $('#table').DataTable({
            searching: false
        });
    } );
</script>
@endsection