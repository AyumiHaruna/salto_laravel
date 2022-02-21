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
        <div id="calendar_main_content" class="col-10" style="margin-left: 8%;margin-top: 2%;">
            <form action="{{ route('Calendario.store') }}" method="post">
                {{ csrf_field() }}
                    Nombre de Sesión:
                    <br />
                <input type="text" name="name" />
                    <br /><br />
                    Descripción:
                    <br />
                <textarea name="description"></textarea>
                    <br /><br />
                @if(Session('role') == 4) 
                    Coachee:
                    <br />
                <div class="form-group">
                    <select name="coachee_id" data-plugin="selectpicker" data-noneSelectedText="Ninguno">
                        @if(isset($coaches))
                            @foreach($coachees as $index => $coachee)
                                <option value="{{ $coachee->id }}" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;" >{{ $coachee->name.' '.$coachee->last_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                    <br /><br />
                <input type="hidden" name="coach_id" value="{{Session('user')->id}}" />
                @else
                    Coach:
                    <br />
                <div class="form-group">
                    <select name="coach_id" data-plugin="selectpicker" data-noneSelectedText="Ninguno">
                        @if(isset($coaches))
                            @foreach($coaches as $index => $coach)
                                <option value="{{ $coach->id }}" style="font-family:'AvenirLTStd-Light';font-size: 1.5vh;" >{{ $coach->name.' '.$coach->last_name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                    <br /><br />
                <input type="hidden" name="coachee_id" value="{{Session('user')->id}}" />
                @endif
                    Fecha de Inicio:
                    <br />
                <input type="text" name="start_datetime" class="date" />
                    <br /><br />
                    Fecha Final:
                    <br />
                <input type="text" name="end_datetime" class="date" />
                    <br /><br />
                <input type="hidden" name="status" value="0" />
                <input type="submit" value="Save" />
            </form>
        </div>
    </div>

  @endsection



 
@section('jqueryScripts')

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
<script src="{{ asset('js/mainFunctions.js') }}"></script>
<script>
    $('.date').datepicker({
        autoclose: true,
        dateFormat: "yy-mm-dd"
    });
</script>

@endsection