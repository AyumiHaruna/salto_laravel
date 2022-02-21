<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Chat;

class ChatController extends Controller
{
    //show pay index view
    public function index()
    {
      return view('testTemplate');
    }

    //save msg on file
    public function msg_submit()
    {
        // generate url for file
        $fileurl = "../public/msg/msgl_".$_POST['client'].".json";

        // print_r($_POST);
        if($_POST['role'] == 5)
        {        //if is a client
            // if file doesn´t exists, create new file
            if( !file_exists($fileurl) )
            {
              fopen($fileurl, "w");
            }

            //search if the client has an open chat
            $search = Chat::where('id_coachee', $_POST['client'])->where(function($query)
            {
                  return $query->where('status', 1)
                                ->orWhere('status', 2);
            })->orderBy('created_at', 'desc')->get();

            if (count($search) == 0)
            {
              $chatNumber = Chat::insertGetId([
                "id_coachee" => $_POST['client'],     "file" => "msgl_".$_POST['client'].".json",
                "created_at" => date('Y/m/d h:i:s a', time()),
                "updated_at" => date('Y/m/d h:i:s a', time())
              ]);
            }
            else
            {
              $chatNumber = $search[0]['id'];
            }

            //get data from json file
            $jsonString = file_get_contents( $fileurl );
            $data = json_decode($jsonString, true);

            if( isset($data[ $chatNumber ]) )
            {
                array_push( $data[ $chatNumber ], [
                              "author" => $_POST['client'],
                              "role" => $_POST['role'],
                              "datetime" => date('Y/m/d h:i:s a', time()),
                              "msg" => $_POST['msg']
                        ]);
            }
            else
            {
                $data[ $chatNumber ][0] = [
                              "author" => $_POST['client'],
                              "role" => $_POST['role'],
                              "datetime" => date('Y/m/d h:i:s a', time()),
                              "msg" => $_POST['msg']
                        ];
            }
        }             //  end if is a client
        else
        {       //if is a support

            $chatNumber = Chat::where('id_coachee', $_POST['client'])->select('id')->orderBy('id', 'desc')->first();
            $chatNumber = $chatNumber['id'];

            //get data from json file
            $jsonString = file_get_contents( $fileurl );
            $data = json_decode($jsonString, true);

            array_push( $data[ $chatNumber ], [
                          "author" => $_POST['support'],
                          "role" => $_POST['role'],
                          "datetime" => date('Y/m/d h:i:s a', time()),
                          "msg" => $_POST['msg']
                        ]);
        }

        $data = json_encode($data);
        file_put_contents($fileurl, $data);

        $query = Chat::where('id', $chatNumber)->update([ "updated_at" => date('Y/m/d h:i:s a', time()) ]);

        return response()->json(['msg'=>'message saved', 'status'=>200, 'chatNumber' => $chatNumber]);
    }

    //get chat messages
    public function msg_get($id_client)
    {
        $fileurl = "../public/msg/msgl_".$id_client.".json";

        if( file_exists($fileurl) )
        {
            //get the las conversation of this client
            $chatId = Chat::where('id_coachee', $id_client)->where(function($query)
            {
                  return $query->where('status', 1)
                                ->orWhere('status', 2);
            })->orderBy('id', 'desc')->select('id')->first();


            if( $chatId['id'] != null )
            {
              //get data from json file
              $jsonString = file_get_contents( $fileurl );
              $data = json_decode($jsonString, true);

              if( $data[ $chatId['id'] ] != null )
              {
                  return response()->json([ "msg"=>"new chat", "status"=>200, "data"=>$data[ $chatId['id'] ], "thisId" => $chatId['id'] ]);
              }
              else
              {
                  return response()->json([ "msg"=>"new chat", "status"=>204 ]);
              }

            }
            else
            {
                return response()->json([ "msg"=>"new chat", "status"=>204 ]);
            }
        }
        else
        {
            return response()->json([ "msg"=>"file not found", "status"=>204 ]);
        }
    }

    //get all pending, or avalible chats
    public function admin_chats_get($id_support)
    {
      $chatList['pendientes'] = Chat::join('users as usr1', 'usr1.id', '=', 'chat.id_coachee')
                                    ->select('chat.*', 'usr1.name as client_name', 'usr1.last_name as client_last_name')
                                    ->where('chat.status', 1)->orderBy('chat.created_at')->get();

      $chatList['activas'] = Chat::join('users as usr1', 'usr1.id', '=', 'chat.id_coachee')
                                    ->select('chat.*', 'usr1.name as client_name', 'usr1.last_name as client_last_name')
                                    ->where('chat.id_support', $id_support)->where('chat.status', 2)->orderBy('chat.created_at')->get();



      return response()->json([ "msg"=>"chat list", "status"=>200, "data"=>$chatList ]);
    }

    //get all specific client chats
    public function get_this_client_chats()
    {
        $lastChat = Chat::where('id_coachee', $_POST['client'])->orderBy('id', 'desc')->first();

        if ( $_POST['type'] == 'pending' ) {
          //test if the ticket is still pending
          if( $lastChat['id_support'] != null && $lastChat['id_support'] != $_POST['support']  ){             //el ticket ya ha sido tomado por alguien mas
              return response()->json([ "msg"=>"Ticket already taken", "status"=>204 ]);
          } else {
              //update this ticket with support id to take it
              $query = Chat::where('id', $lastChat['id'])->update([ 'status' => 2, 'id_support' => $_POST['support'], 'updated_at' => date('Y/m/d h:i:s a', time()),  'attended_at' => date('Y/m/d h:i:s a', time()) ]);
          }
        }

        //if is type=active, or already taken in the last funciton,   get file with all the chats of this client
        $jsonString = file_get_contents( '../public/msg/'.$lastChat['file'] );      //file allways exists
        $data = json_decode($jsonString, true);

        return response()->json([ "msg"=>"Ticket take success", "status"=>200, "data"=>json_encode($data), "last_chat_id" => $lastChat['id'] ]);
    }

    //close a ticket conversation(chat)
    public function close_chat_ticket()
    {
        //get the last conversation from this client
        $lastChat = Chat::where('id_coachee', $_POST['client'])->orderBy('id', 'desc')->first();
        $query = Chat::where('id', $lastChat['id'])->update([ 'status' => 3, 'updated_at' => date('Y/m/d h:i:s a', time()), 'closed_at' => date('Y/m/d h:i:s a', time()) ]);

        //send last message (-chat terminado-)
        //get data from json file
        $fileurl = "../public/msg/msgl_".$_POST['client'].".json";
        $jsonString = file_get_contents( $fileurl );
        $data = json_decode($jsonString, true);

        array_push( $data[ $lastChat['id'] ], [
                      "author" => $_POST['support'],
                      "role" => $_POST['role'],
                      "datetime" => date('Y/m/d h:i:s a', time()),
                      "msg" => '- Ticket cerrado -'
                    ]);

        $data = json_encode($data);
        file_put_contents($fileurl, $data);

        return response()->json([ "msg"=>"Ticket closed", "status"=>200 ]);
    }
}
