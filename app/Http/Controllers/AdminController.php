<?php

namespace App\Http\Controllers;
;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use App\BlogTemas;
use App\BlogPost;
use App\BlogLike;
use App\BlogTemasXPost;
use App\User;
use App\Resources;
use App\Company;
use App\Sessions;
use App\UsersXcoaches;
use DateTime;
use Session;
use app\Http\commonFunc;
use Validator;

class AdminController extends Controller
{
    //get the title of this page
    public function getPageTitle( $sectionNumber )
    {
      $permission = DB::table('permission_role')
          ->where('role_id','=',Session('role'))
          ->where('permission_id','=',$sectionNumber)
          ->get();

      $section = null;
      foreach(Session('menu_info') as $group){
          foreach($group->permissions as $menu_item){
              if($menu_item->id == $sectionNumber){ // The Calendar permission id is 2
                  $section = $menu_item;
                  break;
              }
          }
      }

      return $section;
    }



    //-- Blog - Categories
    // show full List of categories
    public function blogCategoriesIndex()
    {
        $currentURL = \URL::current();
        $blog_admin = ( (strpos($currentURL, 'Admin_Blog') !== false)? true : false );

        $search = BlogTemas::get();
        return view('blog.blogCategories')->with([ 'temas' => $search, 'blog_admin' => $blog_admin ]);
    }

    // Upload an image on server for a Categorie
    public function blogCategoriesPostImg()
    {
       //get today date to rename files
       $date = new dateTime();
       $date = date_format( $date, 'Ymd');

       $fileName = $date . (rand(1000, 9999)) .$_FILES['myfile']['name'];
       // $test = move_uploaded_file($_FILES['myfile']['tmp_name'], 'img/imgTemas/'.$fileName);
       //  if( $test ) {
       //    echo "Successfully uploaded";
       //  } else {
       //    echo "Not uploaded because of error #".$_FILES["myfile"]["error"];
       //  }
        if (move_uploaded_file($_FILES['myfile']['tmp_name'], 'img/imgTemas/'.$fileName)) {
            echo $fileName;
        } else {
            echo "error";
        }
    }

    // Save a new categorie on DB
    public function blogCategoriesCreate()
    {
      // get info from form
      $foto = (( $_POST['foto'] != null )? $_POST['foto'] : "" );
      //delete non alphanumeric characters and change spaces with lowercases
      $originals = 'ABCDEFGHIJKLMNOPQRSTVWXYZÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
      $mods = 'abcdefghijklmnopqrstvwxyzaaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
      $display_url = utf8_decode($_POST['descripcion']);
      $display_url = strtr($display_url, utf8_decode($originals), $mods);
      $display_url = preg_replace("/[^A-Za-z0-9_ ]/", '', $display_url);
      $display_url = preg_replace('/\s+/', '_', $display_url);

      $query = BlogTemas::where('display_url', $display_url)->get();

      if( count($query) == 0 )      //if categorie doesn't exists
      {
          //save POST on DB
          $query = BlogTemas::create([
              'descripcion' => $_POST['descripcion'],
              'display_url' => $display_url,
              'foto' =>  $foto,
              'activo' => 1
          ]);
          //return to categories view
          return redirect()->back()->withSuccess('¡Categoría creada exitosamente!');
      }
      else            //if categorie alrready exists, return error msg
      {
          return Redirect::back()->withErrors(['¡Ésta categoría ya existe!']);
      }
    }

    // Update an existing categorie on DB
    public function blogCategoriesUpdate()
    {
        //delete non alphanumeric characters and change spaces with lowercases
        $originals = 'ABCDEFGHIJKLMNOPQRSTVWXYZÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $mods = 'abcdefghijklmnopqrstvwxyzaaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $display_url = utf8_decode($_POST['descripcion']);
        $display_url = strtr($display_url, utf8_decode($originals), $mods);
        $display_url = preg_replace("/[^A-Za-z0-9_ ]/", '', $display_url);
        $display_url = preg_replace('/\s+/', '_', $display_url);

        $query = BlogTemas::where('display_url', $display_url)->where('id', '!=', $_POST['id'])->get();
        if( count($query) == 0 )      //if categorie doesn't exists
        {
            //update POST on DB
            $query = BlogTemas::where('id', '=', $_POST['id'])->update([
                'descripcion' => $_POST['descripcion'],  'display_url' => $display_url,
                'foto' =>  $_POST['foto'], 'activo' => 1
            ]);
            //return to categories view
            return redirect()->back()->withSuccess('¡Categoría modificada exitosamente!');
        }
        else            //if categorie alrready exists, return error msg
        {
            return Redirect::back()->withErrors(['¡Imposible modificar, El nuevo nombre ya existe!']);
        }
    }

    // toggle categorie status ('activo')
    public function blogCategoriesToggle()
    {
      $stat = $_POST['stat'];
      $id = $_POST['id'];

      if ($stat == 1 ) {
        $stat = 0;
        $msg = 'deshabilitada';
      } else if($stat == 0) {
        $stat = 1;
        $msg = 'habilitada';
      }

      $query = BlogTemas::where('id', '=', $id)->update([
          'activo' => $stat
      ]);

      echo $stat;
    }



    //--  Blog - Posts
    // show list of Posts
    public function blogPostIndex( Request $request, $url )
    {
        $currentURL = \URL::current();
        $blog_admin = ( (strpos($currentURL, 'Admin_Blog') !== false)? true : false );

        $queryTemas = BlogTemas::where('display_url', $url )->first();

        //get posts ids that has $id categorie
        $postNumbers = BlogTemasXPost::join('blogtemas', 'blogtemasxpost.id_Tema', '=', 'blogtemas.id')
                  ->select('blogtemasxpost.*', 'blogtemas.descripcion')
                  ->where('blogtemasxpost.id_Tema', $queryTemas['id'])->orderBy('blogtemasxpost.id_Post')->get();

        //get the info of that posts
        $postList = [];
        for ($x=0; $x<count($postNumbers); $x++) {
          $query = BlogPost::where('id', $postNumbers[$x]['id_Post'])
            ->select('id', 'visible', 'titulo', 'display_url', 'foto', 'created_at', 'publiDate')->first();

            //if the user is not an admin or blogger, just add visible and publicDate > today, post on array
            if( Session('role') != 1 && Session('role') != 3 ){
              if( $query->visible == 1 &&date("Y-m-d") >= date('Y-m-d', strtotime($query->publiDate)) ){
                $postList[] = $query;
              }
            } else {
              $postList[] = $query;
            }
        }

        //custom paginate function
        // Get current page form url e.x. &page=1
       $currentPage = LengthAwarePaginator::resolveCurrentPage();
       // Create a new Laravel collection from the array data
       $itemCollection = collect($postList);
       // Define how many items we want to be visible in each page
       $perPage = 3;
       // Slice the collection to get the items to display in current page
       $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
       // Create our paginator and pass it to the view
       $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
       // set url path for generted links
       $paginatedItems->setPath($request->url());

       //return view('items_view', ['items' => $paginatedItems]);
       return view('blog.blogPostIndex')->with([ 'theme' => $queryTemas,  'items' => $paginatedItems, 'blog_admin' => $blog_admin ]);
    }

    // show a single post
    public function blogPostSingle( $url )
    {
        $currentURL = \URL::current();
        $blog_admin = ( (strpos($currentURL, 'Admin_Blog') !== false)? true : false );

        //get post register whit $id
        $post = BlogPost::where('display_url', $url)->first();

        //get posts ids that has $id post
        $themes = BlogTemasXPost::join('blogtemas', 'blogtemasxpost.id_Tema', '=', 'blogtemas.id')
                  ->select('blogtemasxpost.*', 'blogtemas.descripcion', 'blogtemas.display_url')
                  ->where('blogtemasxpost.id_Post', $post['id'])->get();

        //search the count of likes, and if has been liked by the user
        $noLikes = BlogLike::where('id_Post', $post['id'])->count();
        if( Session('user') != null ){      //if session exists
            $liked = BlogLike::where('id_Post', $post['id'])->where('id_Usuario', Session('user')->id)->first();
            if( $liked == null ){
              $liked = false;
            } else {
              $liked = true;
            }
        } else {
          $liked = false;
        }

        return view('blog.blogPostShow')
        ->with([
          'themes' => $themes,  'post' => $post,
          'noLikes' => $noLikes, 'liked' => $liked,
          'blog_admin' => $blog_admin
        ]);
    }

    // form to create new post
    public function blogPostCreate()
    {
      $currentURL = \URL::current();
      $blog_admin = ( (strpos($currentURL, 'Admin_Blog') !== false)? true : false );

      //get list of categories
      $themes = BlogTemas::where('activo', 1)->get();
      return view('blog.blogPostCreate')
          ->with([ 'themes' => $themes, 'blog_admin' => $blog_admin ]);
    }

    // save a new post on DB
    public function blogPostStore(Request $request)
    {
        $currentURL = \URL::current();
        $blog_admin = ( (strpos($currentURL, 'Admin_Blog') !== false)? 'Admin_Blog' : 'Blog' );

        //validate data
        $validator = Validator::make($request->all(),[
            'titulo' => 'required|min:3|max:255',
            'metatag' => 'required|min:3|max:255',
            'publiDate' => 'required|date_format:"Y-m-d"'
        ]);

        if( $validator->fails() )
        {
            return redirect()->back()->withErrors($validator, 'mainForm')
              ->with('type', 'config')->with('session_id',0)->withInput();
        }

        //delete non alphanumeric characters and change spaces with lowercases
        $originals = 'ABCDEFGHIJKLMNOPQRSTVWXYZÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $mods = 'abcdefghijklmnopqrstvwxyzaaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $display_url = utf8_decode($_POST['titulo']);
        $display_url = strtr($display_url, utf8_decode($originals), $mods);
        $display_url = preg_replace("/[^A-Za-z0-9_ ]/", '', $display_url);
        $display_url = preg_replace('/\s+/', '_', $display_url);

        if( $_POST['type'] == 'create' ){
          //save post and return id of the post
          $thisId = BlogPost::insertGetId([
            'foto' => $_POST['foto'], 'titulo' => $_POST['titulo'], 'display_url' => $display_url, 'metatag' => $_POST['metatag'], 'mensaje' => $_POST['mensaje'],
            'id_usuario' => Session('user')->id, 'visible' => ((isset($_POST['visible']))? 1 : 0), 'likes' => 0,
            'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'publiDate' => $_POST['publiDate']
          ]);

          //save post categories
          for ($x=0; $x<count($_POST['tema']); $x++) {
              $query = BlogTemasXPost::create([
                'id_Tema' => $_POST['tema'][$x],
                'id_Post' => $thisId
              ]);
          }
          return redirect($blog_admin.'/post/single/'.$display_url);

        } else if( $_POST['type'] == 'update' ){
          //delete data from post in BlogTemasXPost
          $query = BlogTemasXPost::where('id_Post', $_POST['id'])->delete();
          //update post data
          $query = BlogPost::where('id', $_POST['id'])->update([
              'foto' => $_POST['foto'], 'titulo' => $_POST['titulo'], 'display_url' => $display_url, 'metatag' => $_POST['metatag'], 'mensaje' => $_POST['mensaje'],
              'id_usuario' => Session('user')->id, 'visible' => ((isset($_POST['visible']))? 1 : 0), 'likes' => 0,
              'updated_at' => date('Y-m-d H:i:s'), 'publiDate' => $_POST['publiDate']
          ]);
          //save post categories
          for ($x=0; $x<count($_POST['tema']); $x++) {
              $query = BlogTemasXPost::create([
                'id_Tema' => $_POST['tema'][$x],
                'id_Post' => $_POST['id']
              ]);
          }
          return redirect($blog_admin.'/post/single/'.$display_url);
        }
    }

    // toggle post status ('activo')
    public function blogPostToggle()
    {
      $stat = $_POST['stat'];
      $id = $_POST['id'];

      if ($stat == 1 ) {
        $stat = 0;
      } else if($stat == 0) {
        $stat = 1;
      }

      $query = BlogPost::where('id', '=', $id)->update([
          'visible' => $stat
      ]);

      echo $stat;
    }

    // show form to update post
    public function blogPostUpdate( $id )
    {
      $currentURL = \URL::current();
      $blog_admin = ( (strpos($currentURL, 'Admin_Blog') !== false)? true : false );

      //get post whith $id
      $post = BlogPost::where('id', $id)->first();

      //get list of categories
      $themes = BlogTemas::where('activo', 1)->get();

      //get categorie list of the post
      $catList = BlogTemasXPost::where('id_post', $id)->select('id_Tema')->get();

      // print_r(json_encode($catList));
      return view('blog.blogPostCreate')
          ->with([ 'themes' => $themes, 'post' => $post, 'catList' => $catList, 'blog_admin' => $blog_admin ]);
    }

    //toggle a user like
    public function blogLikeToggle()
    {
      if( $_POST['actual_stat'] == 0 ){
        //if isn't exists - create it
        $like = BlogLike::create([
          'id_Usuario' => Session('user')->id,
          'id_Post' => $_POST['id_post']
        ]);
        $actualStat = 1;
      } else {
        //if exists - destroys it
        $like = BlogLike::where('id_Usuario', Session('user')->id)
          ->where('id_Post', $_POST['id_post'])->delete();
        $actualStat = 0;
      }
      //get the number of likes
      $noLikes = BlogLike::where('id_Post', $_POST['id_post'])->count();

      //return a json whith values
      $response['noLikes'] = $noLikes;
      $response['actualStat'] = $actualStat;

      print_r(json_encode($response));
    }



    //--  Resources
    // // show list of resources
    // public function resourcesIndex()
    // {
    //   $currentURL = \URL::current();
    //   $resource_admin = ( (strpos($currentURL, 'Admin_Recursos') !== false)? true : false );
    //   $resources = Resources::orderBy('created_at', 'desc')->paginate(10);
    //   return view('resources.resourcesIndex')->with(['resources' => $resources, 'resource_admin' => $resource_admin]);
    // }
    //
    // // upload file to server
    // public function resPostFile()
    // {
    //   //get today date to rename files
    //   $date = new dateTime();
    //   $date = date_format( $date, 'Ymd');
    //
    //   $fileName = $date . (rand(1000, 9999)) .$_FILES['myfile']['name'];
    //
    //    if (move_uploaded_file($_FILES['myfile']['tmp_name'], 'files/'.$fileName)) {
    //        echo $fileName;
    //    } else {
    //        echo "error";
    //    }
    // }
    //
    // // store the uploaded file info into db
    // public function resStore()
    // {
    //     //insert resource info
    //     $query = Resources::create([
    //         'descripcion' => $_POST['descripcion'],     'url' =>  $_POST['url'],     'downloads' => 0,
    //         'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')
    //     ]);
    //
    //     //return to resources view
    //     return redirect()->back()->withSuccess('¡Recurso guardado exitosamente!');
    // }
    //
    // // update resource data in db
    // public function resUpdate()
    // {
    //   //update resource info
    //   $query = Resources::where('id', $_POST['id'])->update([
    //       'descripcion' => $_POST['descripcion'],     'url' =>  $_POST['url'],
    //       'updated_at' => date('Y-m-d H:i:s')
    //   ]);
    //   //return to resources view
    //   return redirect()->back()->withSuccess('¡Recurso modificado exitosamente!');
    // }
    //
    // // delete resource from db
    // public function resDelete()
    // {
    //   $query = Resources::where('id', $_POST['id'])->select('url')->first();
    //   unlink( 'files/'.$query['url'] );
    //   $query = Resources::where('id', $_POST['id'])->delete();
    //   return $_POST['id'];
    // }
    //
    // // add +1 on resources -> download register
    // public function resDownPlus()
    // {
    //   $noDownloads = Resources::where('id', $_POST['id'])->select('downloads')->first();
    //   $query = Resources::where('id', $_POST['id'])->update([ 'downloads' => ( $noDownloads['downloads'] + 1) ]);
    //   echo ( $noDownloads['downloads'] + 1);
    // }



    //--  perfil
    // show perfil info, whit ajax editable blade
    public function perfilIndex()
    {
      //get User info
      $user = User::where('id', Session('user')['id'])->first();

      //get company name
      $company = Company::where('id', $user['company_id'])->first();
      return view('perfil.indexPerfil')->with(['user' => $user, 'company' => $company]);
    }

    //  upload a file on server
    public function perfilUploadFile()
    {
      //get old file name
      if( $_POST['type'] == 'photo'){
        $oldFile = User::where('id', $_POST['id'])->select('photo')->first();
        $oldFile = $oldFile['photo'];
      } else if( $_POST['type'] == 'cv') {
        $oldFile = User::where('id', $_POST['id'])->select('cv')->first();
        $oldFile = $oldFile['cv'];
      }

      //delete the old file name
      (($oldFile != null)? unlink( 'files/usersFiles/'.$oldFile ) : '' );

      //get today date to rename files
      $date = new dateTime();
      $date = date_format( $date, 'Ymd');
      $fileName = $date . (rand(1000, 9999)) .$_FILES['myfile']['name'];

      //move to server
      move_uploaded_file($_FILES['myfile']['tmp_name'], 'files/usersFiles/'.$fileName);

      //update database
      if( $_POST['type'] == 'photo'){
        $query = User::where('id', $_POST['id'])->update(['photo' => $fileName]);
      } else if( $_POST['type'] == 'cv') {
        $query = User::where('id', $_POST['id'])->update(['cv' => $fileName]);
      }

      //print the final file name
      echo $fileName;
    }

    // update perfil info
    public function perfilUpdate()
    {
      // update User DB
      $query = User::where('id', $_POST['id'])->update([ $_POST['flag'] => $_POST['value'] ]);
      echo $_POST['value'];
    }



    //--  Clients
    // show a list of clients related to a coach
    public function clientIndex(){
      $finalArray = [];
      $clientList = [];
      $querySessions = Sessions::where('coach_id', Session('user')->id)
        ->where('status', '!=', 5)
        ->where('status', '!=', 6)
        ->get();

      for ($x=0; $x < count($querySessions) ; $x++) {
        if (!in_array($querySessions[$x]['coachee_id'], $clientList) && $querySessions[$x]['coachee_id'] != 0) {
          $clientList[] = $querySessions[$x]['coachee_id'];
          $finalArray[ $querySessions[$x]['coachee_id'] ] = [];

          $userData = User::where('id', $querySessions[$x]['coachee_id'])->first();

          $finalArray[ $querySessions[$x]['coachee_id'] ]['id'] = $querySessions[$x]['coachee_id'];
          $finalArray[ $querySessions[$x]['coachee_id'] ]['full_name'] = $userData['name'].' '.$userData['last_name'];
          $finalArray[ $querySessions[$x]['coachee_id'] ]['mail'] = $userData['email'];

          $birthDate = $userData['birthdate'];
          $today = date("Y-m-d");
          $diff = date_diff(date_create($birthDate), date_create($today));
          $finalArray[ $querySessions[$x]['coachee_id'] ]['age'] = $diff->format('%y');

          $finalArray[ $querySessions[$x]['coachee_id'] ]['photo'] = $userData['photo'];
          $finalArray[ $querySessions[$x]['coachee_id'] ]['noSesiones'] = Sessions::where('coach_id', Session('user')->id)
                                                                                  ->where('coachee_id', $querySessions[$x]['coachee_id'])
                                                                                  ->where('status', 3)->count();

          $visionData = DB::table('user_vision')->where('user_id', $querySessions[$x]['coachee_id'])->first();
          if ($visionData != null){
              $finalArray[ $querySessions[$x]['coachee_id'] ]['vision'] = $visionData->vision;
          } else {
              $finalArray[ $querySessions[$x]['coachee_id'] ]['vision'] = '';
          }

          $crossData = UsersXcoaches::where( 'id_user', $querySessions[$x]['coachee_id'] )
                                      ->where( 'id_coach', Session('user')->id )->first();

          if($crossData != null){
            $finalArray[ $querySessions[$x]['coachee_id'] ]['perfilCliente'] = $crossData['perfilCliente'];
            $finalArray[ $querySessions[$x]['coachee_id'] ]['seguimientoCliente'] = $crossData['seguimientoCliente'];
          } else {
            $finalArray[ $querySessions[$x]['coachee_id'] ]['perfilCliente'] = '';
            $finalArray[ $querySessions[$x]['coachee_id'] ]['seguimientoCliente'] = '';
          }

          $finalArray[ $querySessions[$x]['coachee_id'] ]['goals'] = DB::table('user_goals')->where('user_id', $querySessions[$x]['coachee_id'])->orderBy('date', 'desc')->get();
        }
      }

      $section = null;
      foreach(Session('menu_info') as $group){
          foreach($group->permissions as $menu_item){
              if($menu_item->id == 7){ // The clients permission is 7
                  $section = $menu_item;
                  break;
              }
          }
      }

      return view('clientes.clientIndex')->with([ 'section' => $section,
                                                  'clientList' => $finalArray ]);
      // print_r( json_encode($finalArray) );
      // echo count($finalArray);
    }

    // update profil or seguimiento
    public function clientUpdate(){
      print_r($_POST);
      $field = $_POST['type'];
      $val = (( isset($_POST['val']) )? $_POST['val'] : '');

      $query = UsersXcoaches::where('id_coach', $_POST['coach_id'])
                              ->where('id_user', $_POST['coachee_id'])
                              ->update([
                                $field => $val
                              ]);
      // echo 'ok';
    }
}
