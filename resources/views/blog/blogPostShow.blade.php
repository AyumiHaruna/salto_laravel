@extends('layouts.mainLayout')


  @section('title') Blog Coaching @endsection

  @section('extraheader')
    <link rel="stylesheet" href="{{ asset('css/blog/style.css') }}">

    <meta name="titulo" content="{{ $post->titulo }}">
    <meta name="description" content="{{ $post->metatag }}">

    <!-- google + share button -->
    <script src="https://apis.google.com/js/platform.js" async defer>
      {lang: 'es-419'}
    </script>
  @endsection


  @section('content')
      <div class="container-fluid postContainer" id="mainContainer">
        <div class="row">
          <div class="col-md-12 text-center" id="postDate">
              {{ date_format( DateTime::createFromFormat('Y-m-d', $post->publiDate), 'd-M-Y') }}
          </div>
          <div class="col-md-12 text-center">
            <div class="row">
              <div class="col-md-12" id="title">
                  {{ $post->titulo }}
              </div>
              <div class="col-md-2 offset-md-5 text-center">
                <hr>
              </div>
              <div class="col-md-12">
                @FOR($x=0; $x<count($themes); $x++)
                  <a href="{{ url((($blog_admin == true)? 'Admin_Blog' : 'Blog' ).'/post/show/'.$themes[$x]['display_url']) }}"><button type="button" class="btn catBtn">{{ $themes[$x]['descripcion'] }}</button></a>
                  {{ (($x == (count($themes)) - 1)? '' : ',' ) }}
                @ENDFOR
              </div>
            </div>
          </div>

          <div class="col-md-10 offset-md-1 text-center imgContainer">
            <img src="{{ asset('img/imgTemas/'.$post->foto) }}" alt="" id="imgPost">
          </div>
          <div class="col-md-10 offset-md-1 text-right">
            <button type="button" name="button" class="btn zoomBtn" id="text-plus"><i class="fas fa-search-plus fa-lg"></i></button>
            &nbsp;&nbsp;&nbsp;
            <button type="button" name="button" class="btn zoomBtn" id="text-minus"><i class="fas fa-search-minus fa-lg"></i></button>
          </div>
          <div class="col-md-8 offset-md-2" id="postMsj">
            {!! $post->mensaje !!}
          </div>
          <div class="col-md-12">
              <hr>
          </div>

          <!-- <div class="col-md-6 offset-md-6 text-center likeBlock"> -->
          <div class="col-md-12 text-center likeBlock">
            <div class="row justify-content-end">
              <div class="col-2">
                @IF( Session('user') != null )
                  <button type="button" name="button" class="btn {{ (($liked == false)? '' : 'iColor' ) }} " id="likeBtn" metaVal="{{ (($liked == false)? '0' : '1' ) }}"> <i class="{{ (($liked == false)? 'far ' : 'fas ' ) }}fa-thumbs-up fa-lg"></i> </button>
                  <span id="noLikes">{{ $noLikes }}</span>
                @ENDIF
              </div>

              <div class="col-4">
                <!-- share on twitter -->
                <div class="">
                  <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-show-count="false" data-size="large">Tweet</a>
                  <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>


                <div id="fb-root"></div>
                <!-- shate on facebook -->
                <!-- <div class="fb-share-button"
                  data-href=""
                  data-layout="button_count">
                </div> -->
                <div class="fb-share-button" data-href="{{ Request::url() }}" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}" class="fb-xfbml-parse-ignore">Compartir</a></div>

                <!-- share on g + -->
                <div class="g-plus" data-action="share" data-annotation="bubble" data-height="24"></div>
                <!-- <a href="https://plus.google.com/share?url='{{ URL::current() }}'" onclick="javascript:window.open(this.href,
                '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><img
                src="	https://www.gstatic.com/images/icons/gplus-32.png" alt="Share on Google+"/></a> -->
              </div>

            </div>









          </div>
          @IF(false)
            <div class="col-md-12 text-center">
              @include('partials._btnAgendarCita')
            </div>
          @ENDIF
        </div>
      </div>
  @endsection


  @section('jqueryScripts')

  <!-- facebook sdk -->
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>


    <script type="text/javascript">
      $(document).ready(function(){
        $("#text-plus").on('click', function(){
          $("#postMsj").children().css({'font-size':'+=2px'});
          $("#postMsj").children().children().css({'font-size':'+=2px'});
          $("#postMsj").children().children().children().css({'font-size':'+=2px'});
        });
        $("#text-minus").on('click', function(){
          $("#postMsj").children().css({'font-size':'-=2px'});
          $("#postMsj").children().children().css({'font-size':'-=2px'});
          $("#postMsj").children().children().children().css({'font-size':'-=2px'});
        });

        //toogle categorie stat
        $("#likeBtn").on('click', function(){
          var actualVal =  $(this).attr('metaVal');
            $.ajax({
              data: { "_token": "{{ csrf_token() }}",
                      "id_post": {{ $post->id }},
                      "actual_stat": actualVal
                    },
              type: "POST",
              url: "{{ url((($blog_admin == true)? 'Admin_Blog' : 'Blog' ).'/like/toggle') }}"
            })
            .done(function(data){
              data = JSON.parse(data);
              $('#likeBtn').attr('metaVal', data['actualStat']);    // change btn metaVal data
              //change icon and style of #likeBtn
              if( data['actualStat'] == 0 ){  // 0 =  no like
                $('#likeBtn').html('<i class="far fa-thumbs-up fa-2x"></i>');
                $('#likeBtn').removeClass('iColor');
              } else {    // 1 = like
                $('#likeBtn').html('<i class="fas fa-thumbs-up fa-2x"></i>');
                $('#likeBtn').addClass('iColor');
              }
              //set the number of likes in post
              $("#noLikes").html( data['noLikes'] );
            })
            .fail(function(data){
              console.log('likeBtn toggler:(fail)')
            });
          });
      });
    </script>
  @endsection
