<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Audios_category;
use App\Audios;
use App\Videos;
use DateTime;
use Session;
use Validator;

class ResourcesController extends Controller
{
    //----------------------------------------------------------
    //                        AUDIOS
    //----------------------------------------------------------
    //show pay index view
    public function admin_audios_index()
    {
      //get page title
      $section = $this->getPageTitle(23);

      //get category list
      $categories = Audios_category::where('active', 1)->get();

      for ($x=0; $x < count($categories); $x++) {
        $categories[$x]['audios'] = Audios::where('category', $categories[$x]['id'])->where('active', 1)->orderBy('position')->get();
      }
      return view('audios.admin_audios_index', [
        'categories' => $categories,
        'section' => $section
      ]);
    }

    //show form to create category
    public function admin_audio_form_category_create()
    {
      return view('audios.admin_audio_form_category_create');
    }

    //show form to update category
    public function admin_audio_form_audio_update( $id_cat )
    {
      $data = Audios_category::where('id', $id_cat)->first();
      return view('audios.admin_audio_form_category_update')->with([ 'data' => $data ]);
    }

    //save the new category
    public function admin_audio_form_category_update_save(Request $request)
    {
        // print_r($_POST);
        // generate random names for the files
        $date = new dateTime();
        $date = date_format( $date, 'Ymd');

        //if thumbnail change
        if(  $_FILES['thumbnail']['name'] != ''){
            $imgName = $this->getUrlText($_FILES['thumbnail']['name']);
            $imgName = $date . (rand(1000, 9999)) .$imgName;
            if ( move_uploaded_file($_FILES['thumbnail']['tmp_name'], 'img/web/audios/'.$imgName) ) {
                $query = Audios_category::where('id', $_POST['id_cat'])->update([ 'thumbnail' => $imgName ]);
            } else {
                 return Redirect::back()->with([
                   'msg' => 'Ocurrió un error al cargar la imagen miniatura, favor de reintentar',
                   'status' => 204
                 ]);
            }
        }

         //generate a valid name for the category
         $display_name = $this->getUrlText($_POST['category']);

          // insert data in audios_category db
         $query = Audios_category::where('id', $_POST['id_cat'])->update([
           'category' => $_POST['category'],
           'display_name' => $display_name,
           'description' => $_POST['description'],
           'updated_at' => date('Y/m/d h:i:s a', time())
         ]);

         return redirect('Admin_Audios')->with([
           'msg' => 'Categoría modificada exitosamente',
           'status' => 200
         ]);
    }

    //show form to create new audio
    public function admin_audio_form_audio_create( $id_cat )
    {
      $category_name = Audios_category::where('id', $id_cat)->select('category')->first();
      $category_name = $category_name['category'];
      return view('audios.admin_audio_form_create')->with([ 'id_category' => $id_cat, 'category_name' => $category_name ]);
    }

    //save the new audio
    public function admin_audio_form_audio_create_save(Request $request)
    {
      // generate random names for the files
      $date = new dateTime();
      $date = date_format( $date, 'Ymd');
      // get avalible url names
      $imgName = $this->getUrlText($_FILES['thumbnail']['name']);
      $audioName = $this->getUrlText($_FILES['audio']['name']);
      $imgName = $date . (rand(1000, 9999)) .$imgName;
      $audioName = $date . (rand(1000, 9999)) .$audioName;

      // get the number of audios of this category to stablish the position
      $countAudios = Audios::where('category', $_POST['category'])->count();
      $position = $countAudios + 1;

      // upload selected image to server
      if ( move_uploaded_file($_FILES['thumbnail']['tmp_name'], 'img/web/audios/'.$imgName) ) {
          // upload selected audio to server
          if ( move_uploaded_file($_FILES['audio']['tmp_name'], 'img/web/audios/'.$audioName) ) {

            // save audio info on DB
            $query = Audios::insert([
                 'category' => $_POST['category'],
                 'title' => $_POST['title'],
                 'description' => $_POST['description'],
                 'url' => $audioName,
                 'thumbnail' => $imgName,
                 'position' => $position,
                 'lock' => ((!isset($_POST['premium_lock']))? 0 : 1),
                 'active' => 1,
                 'created_at' => date('Y/m/d h:i:s a', time()),
                 'updated_at' => date('Y/m/d h:i:s a', time())
               ]);

               return redirect('Admin_Audios')->with([
                 'msg' => 'Audio creado exitosamente',
                 'status' => 200
               ]);

          } else {
               return Redirect::back()->withInput()->with([
                 'msg' => 'Ocurrió un error al cargar el audio, favor de reintentar',
                 'status' => 204
               ]);
           }
        } else {
             return Redirect::back()->withInput()->with([
               'msg' => 'Ocurrió un error al cargar la imagen miniatura, favor de reintentar',
               'status' => 204
             ]);
         }
    }

    //delete audio
    public function delete_audio(Request $request)
    {
        $query = Audios::where('id', $_POST['id_selected'])->update([ 'active' => 0 ]);
        return redirect('Admin_Audios')->with([
          'msg' => 'Audio eliminado exitosamente',
          'status' => 200
        ]);
    }

    //form to update audios
    public function mod_audio($id)
    {
        $audio = Audios::where('id', $id)->first();
        $audio['category_name'] = Audios_category::where('id', $audio['category'])->select('category')->first();
        $audio['category_name'] = $audio['category_name']['category'];
        return view('audios.admin_audio_form_update')->with([ 'data' => $audio ]);
    }

    //save audio updates
    public function mod_audio_save(Request $request)
    {
      // generate random names for the files
      $date = new dateTime();
      $date = date_format( $date, 'Ymd');

      //if thumbnail change
      if(  $_FILES['thumbnail']['name'] != ''){
          $imgName = $this->getUrlText($_FILES['thumbnail']['name']);
          $imgName = $date . (rand(1000, 9999)) .$imgName;
          if ( move_uploaded_file($_FILES['thumbnail']['tmp_name'], 'img/web/audios/'.$imgName) ) {
              $query = Audios::where('id', $_POST['id_audio'])->update([ 'thumbnail' => $imgName ]);
          } else {
               return Redirect::back()->with([
                 'msg' => 'Ocurrió un error al cargar la imagen miniatura, favor de reintentar',
                 'status' => 204
               ]);
          }
      }

      //if audio change
      if( $_FILES['audio']['name'] != ''){
          $audioName = $this->getUrlText($_FILES['audio']['name']);
          $audioName = $date . (rand(1000, 9999)) .$audioName;
          if ( move_uploaded_file($_FILES['audio']['tmp_name'], 'img/web/audios/'.$audioName) ) {
              $query = Audios::where('id', $_POST['id_audio'])->update([ 'url' => $audioName ]);
          } else {
               return Redirect::back()->with([
                 'msg' => 'Ocurrió un error al cargar el audio, favor de reintentar',
                 'status' => 204
               ]);
          }
      }

      // save audio info on DB
      $query = Audios::where('id', $_POST['id_audio'])->update([
           'category' => $_POST['category'],
           'title' => $_POST['title'],
           'description' => $_POST['description'],
           'lock' => ((!isset($_POST['premium_lock']))? 0 : 1),
           'updated_at' => date('Y/m/d h:i:s a', time())
         ]);

       return redirect('Admin_Audios')->with([
         'msg' => 'Audio modificado exitosamente',
         'status' => 200
       ]);
    }


    //----------------------------------------------------------
    //                        VIDEOS
    //----------------------------------------------------------
    //show pay index view
    public function admin_videos_index()
    {
      //get page title
      $section = $this->getPageTitle(24);

      //get category list
      $videos = Videos::where('active', 1)->orderBy('id')->get();

      return view('videos.admin_videos_index', [
        'videos' => $videos,
        'section' => $section
      ]);
    }

    //return new video form create
    public function admin_videos_form_create()
    {
      return view('videos.admin_video_form_create');
    }

    //save the new video
    public function admin_videos_form_save(Request $request)
    {

      // generate random names for the files
      $date = new dateTime();
      $date = date_format( $date, 'Ymd');
      // get avalible url names
      $imgName = $this->getUrlText($_FILES['thumbnail']['name']);
      $videoName = $this->getUrlText($_FILES['video']['name']);
      $imgName = $date . (rand(1000, 9999)) .$imgName;
      $videoName = $date . (rand(1000, 9999)) .$videoName;

      // upload selected image to server
      if ( move_uploaded_file($_FILES['thumbnail']['tmp_name'], 'img/web/videos/'.$imgName) ) {
          // upload selected audio to server
          if ( move_uploaded_file($_FILES['video']['tmp_name'], 'img/web/videos/'.$videoName) ) {
            // save audio info on DB
            $query = Videos::insert([
                 'title' => $_POST['title'],
                 'description' => $_POST['description'],
                 'url' => $videoName,
                 'thumbnail' => $imgName,
                 'lock' => ((!isset($_POST['premium_lock']))? 0 : 1),
                 'active' => 1,
                 'created_at' => date('Y/m/d h:i:s a', time()),
                 'updated_at' => date('Y/m/d h:i:s a', time())
               ]);

               return redirect('Admin_Videos')->with([
                 'msg' => 'Video creado exitosamente',
                 'status' => 200
               ]);

          } else {
               return Redirect::back()->withInput()->with([
                 'msg' => 'Ocurrió un error al cargar el video, favor de reintentar',
                 'status' => 204
               ]);
           }
        } else {
             return Redirect::back()->withInput()->with([
               'msg' => 'Ocurrió un error al cargar la imagen miniatura, favor de reintentar',
               'status' => 204
             ]);
         }
    }

    //delete video
    public function delete_video(Request $request)
    {
      $query = Videos::where('id', $_POST['id_selected'])->update([ 'active' => 0 ]);
      return redirect('Admin_Videos')->with([
        'msg' => 'Video eliminado exitosamente',
        'status' => 200
      ]);
    }

    //return update video form
    public function upd_video( $id )
    {
      $videos = Videos::where('id', $id)->first();
      return view('videos.admin_videos_form_update')->with([ 'data' => $videos ]);
    }

    //save updated video form
    public function upd_video_save(Request $request)
    {
      // generate random names for the files
      $date = new dateTime();
      $date = date_format( $date, 'Ymd');

      //if thumbnail change
      if(  $_FILES['thumbnail']['name'] != ''){
          $imgName = $this->getUrlText($_FILES['thumbnail']['name']);
          $imgName = $date . (rand(1000, 9999)) .$imgName;
          if ( move_uploaded_file($_FILES['thumbnail']['tmp_name'], 'img/web/videos/'.$imgName) ) {
              $query = Videos::where('id', $_POST['id_video'])->update([ 'thumbnail' => $imgName ]);
          } else {
               return Redirect::back()->with([
                 'msg' => 'Ocurrió un error al cargar la imagen miniatura, favor de reintentar',
                 'status' => 204
               ]);
          }
      }

      //if video change
      if( $_FILES['video']['name'] != ''){
          $videoName = $this->getUrlText($_FILES['video']['name']);
          $videoName = $date . (rand(1000, 9999)) .$videoName;
          if ( move_uploaded_file($_FILES['video']['tmp_name'], 'img/web/videos/'.$videoName) ) {
              $query = Videos::where('id', $_POST['id_video'])->update([ 'url' => $videoName ]);
          } else {
               return Redirect::back()->with([
                 'msg' => 'Ocurrió un error al cargar el video, favor de reintentar',
                 'status' => 204
               ]);
          }
      }

      // save video info on DB
      $query = Videos::where('id', $_POST['id_video'])->update([
           'title' => $_POST['title'],
           'description' => $_POST['description'],
           'lock' => ((!isset($_POST['premium_lock']))? 0 : 1),
           'updated_at' => date('Y/m/d h:i:s a', time())
         ]);

       return redirect('Admin_Videos')->with([
         'msg' => 'Video modificado exitosamente',
         'status' => 200
       ]);
    }


    //----------------------------------------
    //             GENERAL FUNCTIONS
    //----------------------------------------
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


    public function getUrlText( $text )
    {
      $originals = 'ABCDEFGHIJKLMNOPQRSTVWXYZÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
      $mods = 'abcdefghijklmnopqrstvwxyzaaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
      $display_name = utf8_decode($text);
      $display_name = strtr($display_name, utf8_decode($originals), $mods);
      $display_name = preg_replace("/[^A-Za-z0-9_.]/", '', $display_name);
      $display_name = preg_replace('/\s+/', '_', $display_name);
      return $display_name;
    }
}
