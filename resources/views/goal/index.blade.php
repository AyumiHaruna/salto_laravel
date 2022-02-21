@extends('layouts.mainLayout')


  @section('title') {{ $section->display_name }} @endsection

  @section('extraheader')
    <link rel="stylesheet" href="{{env('PUBLIC_URL', 'http://localhost/public').'/css/goal.css'}}">
    <link rel="stylesheet" href="{{env('PUBLIC_URL', 'http://localhost/public').'/css/material/material-design.min.css'}}">
    <link rel="stylesheet" href="{{env('PUBLIC_URL', 'http://localhost/public').'/css/bootstrap/bootstrap-extend.min.css'}}">
  @endsection
  <?php
    $months = ["enero","febrero","marzo","abril","mayo","junio", "julio","agosto","septiembre","octubre","noviembre","diciembre"];
  ?>



  @section('content')
  <!-- Page -->
    <div id="main_container" class="row" style="background:url('{{ asset('img/web/saltum_back01.png') }}')">
        <div id="goal_vision" class="col-12 col-md-4">
            <div id="goal_vision_header" class="row">
                <h3 id="goal_vision_header_text" class="goal_title">Visión</h3>
                <div id="goal_vision_header_edit" class="goal_edit_button button"><i class="fas fa-pencil-alt fa-lg"></i></div>
            </div>
            <div id="goal_vision_text">
                <div id="goal_vision_text_input"><textarea type="text" id="goal_vision_text_textarea" value="" placeholder="Escribe tu visión."></textarea><a id="goal_vision_text_guardar">Guardar</a></div><p id="goal_vision_text_paragraph" class="goal_text">{{ (($vision['vision'] != null)? $vision['vision'] : '') }}</p>
            </div>
            <!-- <div id="goal_vision_img">
                <img src="{{ asset('img/goal/01_seguimiento_avion.png') }}" />
            </div> -->
        </div>
        <div id="goal_3monthly" class="col-12 col-md-4">
            <div id="goal_3monthly_header" class="row">
                <h3 id="goal_3monthly_header_text" class="goal_title col-11">Metas<br> trimestrales</h3>
                <div id="goal_3monthly_header_balloon" class="col-1"><img src="{{ asset('img/goal/01_seguimiento_foco.png') }}" /></div>
            </div>
            <div id="goal_3monthly_text">
                <div class="goal_3monthly_goal">
                    <div class="goal_3monthly_goal_check button">
                        @if( isset($trimonthlyGoals) )
                            <?php $first = true; ?>
                            @foreach($trimonthlyGoals as $index => $block)
                                <div class="parent_goal" data-date="<?php
                                    if(is_array ($block)){
                                        echo $block[0]->date;
                                    }else{
                                        echo $block;
                                    } ?>" data-type="0">
                                    <label class="accordion dateContainer goal_date">Fecha: <?php
                                    if(is_array ($block)){
                                        echo date("d", strtotime($block[0]->date)).' de '.$months[date("m", strtotime($block[0]->date))-1].' de '.date("Y", strtotime($block[0]->date));
                                    }else{
                                        echo date("d", strtotime($block)).' de '.$months[date("m", strtotime($block))-1].' de '.date("Y", strtotime($block));
                                    } ?></label>

                                    <div class="panel_2">
                                @if(is_array($block))
                                    @foreach($block as $index2 => $goal)
                                        <label class="container goal_text click_checkbox" data-id="{{ $goal->id }}">
                                            <p class="goal_text_paragraph">{{ $goal->description }}</p>
                                            <input type="checkbox" <?php
                                                if($goal->completed == 1){
                                                    echo 'checked="checked"';
                                                }
                                            ?>>
                                            <span class="checkmark"></span>
                                            <?php if($first){ ?>
                                                <div class="edit_goal_button">
                                                    <img src="{{ asset('img/goal/01_seguimiento_lapiz.png') }}" />
                                                </div>
                                                <div class="goal_text_input">
                                                    <input type="text" class="goal_text_textarea" value="" placeholder="Escribe tu meta."></input>
                                                    <a class="goal_text_guardar">Guardar</a>
                                                </div>
                                            <?php } ?>
                                        </label>
                                    @endforeach
                                @endif
                                    <?php if($first){ ?>
                                        <label class="container goal_add"><u>Añadir nueva meta.</u>
                                            <span class="checkmark">+</span>
                                        </label>
                                    <?php } ?>
                                    </div>
                                </div>
                                <?php   if($first){
                                            $first = false;
                                        } ?>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div id="goal_weekly" class="col-12 col-md-4">
            <div id="goal_weekly_header" class="row">
                <h3 id="goal_weekly_header_text" class="goal_title col-11">Metas<br> semanales</h3>
            </div>
            <div id="goal_weekly_text">
                <div class="goal_weekly_goal" class="row">
                    @if( isset($weeklyGoals) )
                        <?php $first = true; ?>
                        @foreach($weeklyGoals as $index => $block)
                            <div class="parent_goal" data-date="<?php
                                if(is_array ($block)){
                                    echo $block[0]->date;
                                }else{
                                    echo $block;
                                } ?>" data-type="1">
                                <label class="accordion dateContainer goal_date">Fecha: <?php
                                if(is_array ($block)){
                                    echo date("d", strtotime($block[0]->date)).' de '.$months[date("m", strtotime($block[0]->date))-1].' de '.date("Y", strtotime($block[0]->date));
                                }else{
                                    echo date("d", strtotime($block)).' de '.$months[date("m", strtotime($block))-1].' de '.date("Y", strtotime($block));
                                } ?></label>

                                <div class="panel_2">
                            @if(is_array($block))
                                @foreach($block as $index2 => $goal)
                                    <label class="container goal_text click_checkbox" data-id="{{ $goal->id }}">
                                        <p class="goal_text_paragraph">{{ $goal->description }}</p>
                                        <input type="checkbox" <?php
                                            if($goal->completed == 1){
                                                echo 'checked="checked"';
                                            }
                                        ?>>
                                        <span class="checkmark"></span>
                                        <?php if($first){ ?>
                                            <div class="edit_goal_button">
                                                <img src="{{ asset('img/goal/01_seguimiento_lapiz.png') }}" />
                                            </div>
                                            <div class="goal_text_input">
                                                <input type="text" class="goal_text_textarea" value="" placeholder="Escribe tu meta."></input>
                                                <a class="goal_text_guardar">Guardar</a>
                                            </div>
                                        <?php } ?>
                                    </label>
                                @endforeach

                            @endif
                                <?php if($first){ ?>
                                    <label class="container goal_add"><u>Añadir nueva meta.</u>
                                        <span class="checkmark">+</span>
                                    </label>
                                <?php } ?>
                                </div>
                            </div>
                            <?php if($first){
                                    $first = false;
                                } ?>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

  @endsection




@section('jqueryScripts')

    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src="{{ asset('js/jquery.multi-select.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('js/vendor/jquery.datetimepicker.min.css') }}" / >
    <script src="{{ asset('js/vendor/jquery.datetimepicker.full.js') }}"></script>
    <script src="{{ asset('js/vendor/jquery_ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/mainFunctions.js') }}"></script>
    <script src="{{ asset('js/goal.js') }}"></script>
    <script>
        var route_update_vision = "{{env('PUBLIC_URL', 'http://localhost/public').'/Seguimiento/vision'}}";
        var route_update_goal = "{{env('PUBLIC_URL', 'http://localhost/public').'/Seguimiento/meta'}}";
        var route_update_goal_completed = "{{env('PUBLIC_URL', 'http://localhost/public').'/Seguimiento/meta_completada'}}";
        var editImage_url = "{{ asset('img/goal/01_seguimiento_lapiz.png') }}";
        var token = '{{ csrf_token() }}';
    </script>

@endsection
