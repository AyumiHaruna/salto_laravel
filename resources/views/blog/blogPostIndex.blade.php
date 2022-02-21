@extends('layouts.mainLayout')


  @section('title') Blog Coaching @endsection

  @section('extraheader')
    <link rel="stylesheet" href="{{ asset('css/blog/style.css') }}">

    <meta name="description" content="Conoce estrategias que te ayuden a alcanzar tus metas en diferentes áreas de tu vida.">
  @endsection


  @section('content')
      <div class="container" id="mainContainer">
        <div class="row">

          <div class="col-md-12 miniLogo">
            <img src="{{ asset('/img/info/icono_saltum.png') }}">
          </div>

          <div class="col-md-12 postTheme">
            <h1>{{ $theme['descripcion'] }}</h1>
          </div>

          @IF( $blog_admin == true  )
            <div class="col-md-12 text-right">
              <a href="{{ url((($blog_admin == true)? 'Admin_Blog' : 'Blog' ).'/post/create') }}"> <button type="button" name="button" class="btn btn-dark btn-lg" id="newPost"> Nuevo Post &nbsp; <i class="fas fa-plus"></i> </button> </a>
            </div>
          @ENDIF
        </div>

        <div class="row">
          <!-- {{ count($items) }} -->
          @IF( count($items) != 0)
            @foreach ($items as $item)
              @IF( $blog_admin == true || $item->visible == 1 || date("Y-m-d") >= date('Y-m-d', strtotime($item->publiDate))  )
                 <div class="col-md-4" {{ (( $item->visible == 0 || date("Y-m-d") < date('Y-m-d', strtotime($item->publiDate))  )? 'style=opacity:0.5' : '' ) }} id="block{{$item->id}}">
                   <div class="row">
                     <div class="col-md-12 blogSquare">
                       <a href="{{ url((($blog_admin == true)? 'Admin_Blog' : 'Blog' ).'/post/single/'.$item->display_url) }}">
                         <img src="{{ asset('img/imgTemas/'.$item->foto) }}" alt="" class="blogImg">
                         <div class="blogDate text-center">
                           {{ date('Y-M-d', strtotime($item->publiDate)) }}<br>
                         </div>
                         <div class="blogTitle">{{ $item->titulo }}</div>
                       </a>

                       @IF( $blog_admin == true )
                           <a href="{{ url((($blog_admin == true)? 'Admin_Blog' : 'Blog' ).'/post/update').'/'.$item->id  }}"><button type="button" name="button" class="btn btn-block btn-info btn-lg editPostBtn"> Editar Post &nbsp; <i class="fas fa-pencil-alt"></i> </button></a>
                           @IF( $item->visible == 1 )
                             <button type="button" name="button" class="btn btn-block btn-warning btn-lg toggleBtn" metaId="{{ $item->id }}" metaStat="{{ $item->visible }}"> Deshabilitar Post &nbsp; <i class="fas fa-eye-slash"></i> </button>
                           @ELSEIF( $item->visible == 0 )
                             <button type="button" name="button" class="btn btn-block btn-warning btn-lg toggleBtn" metaId="{{ $item->id }}" metaStat="{{ $item->visible }}"> Habilitar Post &nbsp; <i class="far fa-eye"></i> </button>
                           @ENDIF
                       @ENDIF
                     </div>
                   </div>
                 </div>
               @ENDIF
            @endforeach
          @ELSE
            <div class="col-md-12">
              Aun no hay ningun tema para esta categoría
            </div>
          @ENDIF


        </div>
      </div>
    {{ $items->links() }}
  @endsection




  @section('jqueryScripts')
    <script type="text/javascript">
      $(document).ready(function(){
        //toogle categorie stat
        $(".toggleBtn").on('click', function(){
          var btn = $(this);
          var thisBlock =  $("#block"+$(this).attr('metaId'));

            $.ajax({
            data: { "_token": "{{ csrf_token() }}",
                    "id": $(this).attr('metaId'),
                    "stat": $(this).attr('metaStat')
                  },
            type: "POST",
            url: "{{ url((($blog_admin == true)? 'Admin_Blog' : 'Blog' ).'/post/toggle') }}",
            beforeSend: function() {
              btn.html('<i class="fas fa-sync fa-spin"></i>')
            }
            })
            .done(function(data){
              console.log(data);
              if( data == 0 ){
                btn.html('Habilitar Post &nbsp; <i class="far fa-eye"></i>');
                thisBlock.css("opacity", "0.5");
              }else if( data == 1 ){
                btn.html('Deshabilitar Post &nbsp; <i class="fas fa-eye-slash"></i>');
                thisBlock.css("opacity", "1");
              }
              btn.attr('metaStat', data);
            })
            .fail(function(data){
              console.log(data);
            });
          });
      });
    </script>
  @endsection
