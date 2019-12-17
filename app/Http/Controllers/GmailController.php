<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use DB;
use Auth;
use App\User;

class GmailController extends Controller
{
    public function send(Request $req)
    {
/*$email_user = User::where('id', Auth::user()->id)
    ->select('users.email')
    ->first();*/

$id_user = Auth::user()->id;
$user_info = db::table('profiles')
    ->join('users','users.id','=','profiles.user_id')
    ->join('phones','phones.object_id','=','users.id')
    ->where('users.id','=',$id_user)
    ->select('phones.phone','users.email','profiles.name')
    ->first();
      $data=
          [
              'User_info'=>$user_info,
              'Message'=>$req->gmail,
          ];
      Mail::send('users.mail',$data,function($message) use ($data)
      {
          $message->to('olichkakyrylyuk@gmail.com','To Admin')->subject('Земельні справи');
          $message->from('ikiriluk555@gmail.com','From user');
      });
        return redirect()->action('HomeController@index');
/*        {
            $user_id = Auth::user()->email();
           $user_email = Auth::user()->email();
           $message->to('olichkakyrylyuk.gmail.com','To Admin')->subject('Test Email');
          $message->from($user_email,'From user '+$user_id);
           echo "The mail has been sent successfully";
        });*/
    }
}
