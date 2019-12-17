<?php

namespace App\Http\Controllers;

use Date;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\User;
use App\Deal;
use App\Claim;
use Auth;
use App\Step;
use App\Defendant;
use App\Institution;
use App\Profile;
use App\Phone;
use App\Address;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
class AdminController extends Controller
{
    public function home()
    {
        $events = db::select("SELECT steps.id,deals.number,deals.judge,deals.subject_claim,
        steps.type,steps.deal_start,steps.deal_end,
        claims.number as number2,defendants.surname,defendants.name,defendants.fathersname 
        FROM `deals` 
        INNER JOIN claims ON claims.id=deals.claim_id 
        INNER JOIN steps ON steps.deal_id = deals.id 
        INNER JOIN defendants ON defendants.id = deals.defendant_id  ORDER BY `ID` ASC;");
        $event_list = [];
        foreach ($events as  $event) {
            $event_list[] = \Calendar::event(
                $event->number,
                false,
                new \DateTime($event->deal_start),
                new \DateTime($event->deal_end),
                 null,
                 [
	                    'color' => '#5fb591',
	                    'url' => '/admin/deals/find/'.$event->id,
                        'start time'=>$event->deal_start,
                        'end time'=>$event->deal_end,
                     'defaultView'=> 'month'

                 ]
            );
        }
        //$calendar = \Calendar::addEvents($events)->setOptions([ 'defaultDate' => $book->day,'defaultView' => 'agendaDay']);
        $calendar_details = Calendar::addEvents($event_list)->setOptions([
            'defaultView'=> 'month',
            'contentHeight' => 430,
            'themeSystem' => 'bootstrap3',
            'firstDay'=>1,
            'weekends'=> false,


        ]);
        $currentTime = Carbon::now();
        $nextDay = date('Y-m-d', strtotime($currentTime. ' + 1 days'));
        $deals_tommorow = DB::table('deals')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->select('deals.id','deals.number','steps.type')
            ->whereDate('steps.deal_start','=',$nextDay)
            ->count();
        return view('admin.file', compact('calendar_details'),[
            'deals_tommorow'=>$deals_tommorow
        ] );
        }
    public function users()
    {
        $users = User::join('phones', 'phones.object_id', '=', 'users.id')
            ->join('addresses', 'addresses.object_id', '=', 'users.id')
            ->join('profiles', 'profiles.user_id', '=', 'users.id')
            ->where('users.role','user')
            ->select('users.name','users.email','profiles.name as name2','addresses.*', 'phones.phone')
            ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
        ->paginate(3);
        return view('admin.users',[
            'users'=>$users
        ]);
    }


    public function workers()
    {
        $workers = User::join('phones', 'phones.object_id', '=', 'users.id')
            ->join('addresses', 'addresses.object_id', '=', 'users.id')
            ->join('profiles', 'profiles.user_id', '=', 'users.id')
            ->where('users.role','member')
            ->select('users.name','users.email','profiles.name as name2','addresses.*', 'phones.phone')
            ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
            ->paginate(2);
                 return view('admin.workers',[
            'workers'=>$workers
        ]);
    }
    public function insert_member(Request $request)
    {
        $name = $request->input('name');
        $user_name = $request->input('user_name');
        $email = $request->input('email');
        $password = $request->input('password');

      $hashed_password = bcrypt($password);
      $phone = $request->input('phone');
        $index = $request->input('index');
        $place = $request->input('place');
        $street = $request->input('street');
        $street_number = $request->input('street_number');
        $flat = $request->input('flat');
        $created_at = Carbon::now();
        $updated_at = Carbon::now();
      $user = User::create([
            'name'=>$user_name,
            'email'=>$email,
          'role'=>'member',
            'password'=>$hashed_password,
            'created_at'=>$created_at,
            'updated_at'=>$updated_at
        ]);

        $user->save();
        $search = User::where('email',$email)->first();
        $user_id=$search->id;
        $profile = Profile::create([
            'name'=>$name,
            'user_id'=>$user_id,
            'created_at'=>$created_at,
            'updated_at'=>$updated_at
        ]);
$profile->save();
        $phone = Phone::create([
            'phone'=>$phone,
            'object_id'=>$user_id,
            'object_type'=>'users',
            'created_at'=>$created_at,
            'updated_at'=>$updated_at

        ]);
        $phone->save();
        $address = Address::create([
            'object_id'=>$user_id,
            'object_type'=>'users',
            'index'=>$index,
            'place'=>$place,
            'street'=>$street,
            'street_number'=>$street_number,
            'flat'=>$flat
        ]);
        $address->save();
        return redirect()->back()->withSuccess('IT WORKS!');


    }
    public function notifications()
    {
        $date = date('Y-m-d');
        $nextDay = date('Y-m-d', strtotime($date. ' + 1 days'));
        $deals_tommorow = DB::table('deals')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->select('steps.id','deals.number','steps.type')
            ->whereDate('steps.deal_start','=',$nextDay)
            ->get();
        $deals_today = DB::table('deals')
            ->join('steps', 'steps.deal_id', '=', 'deals.id')
            ->select('steps.id','deals.number','steps.type')
            ->whereDate('steps.deal_start','=',$date)
            ->get();
        return view('admin.notification',[
            'deals_tommorow'=>$deals_tommorow,
            'deals_today'=>$deals_today
        ]);

    }

public function editprofile()
{
    $profile = db::table('users')
        ->join('profiles','profiles.user_id','=','users.id')
        ->join('phones','phones.object_id','=','users.id')
        ->join('addresses','addresses.object_id','=','users.id')
        ->select('profiles.name','users.email','users.password','profiles.date_of_birth','phones.phone','addresses.index','addresses.place','addresses.street','addresses.street_number','addresses.flat')
        ->where('users.id','=',1)
        ->first();
    return view('admin.profile',['profile'=>$profile]);

}
public function do_editprofile(Request $request)
{
    $name = $request->input('name');
    $email = $request->input('email');
    $password = $request->input('password');
    $hashedpassword = bcrypt($password);
    $date_of_birth = $request->input('date_of_birth');
    $phone = $request->input('phone');
    $index = $request->input('index');
    $place = $request->input('place');
    $street = $request->input('street');
    $street_number = $request->input('street_number');
    $flat = $request->input('flat');
    $user = User::find(1);
    $user->email = $email;
    $user->password = $hashedpassword;
    $user->save();
    $user1 = Profile::find(1);
    $user1->name=$name;
    $user1->date_of_birth = $date_of_birth;
    $user1->save();
    $user2=Phone::find(1);
    $user2->phone = $phone;
    $user2->save();
    $user3=Address::find(1);
    $user3->index = $index;
    $user3->place = $place;
    $user3->street = $street;
    $user3->street_number = $street_number;
    $user3->flat = $flat;
    $user3->save();
  return redirect()->action('AdminController@editprofile');
}
public function editone($id, Request $request)
{
    $number2=$request->input('number2');
    $reason=$request->input('reason');
    $type=$request->input('type');
    $deal_start=$request->input('deal_start');
    $deal_end=$request->input('deal_end');
    $name2=$request->input('name2');
    $phone2=$request->input('phone2');
    $name=$request->input('name');
    $phone=$request->input('phone');
    $surname=$request->input('surname');
    $name3=$request->input('name3');
    $email=$request->input('email');
    $step_id = Step::find($id);
    $step_id->type=$type;
    $step_id->deal_start = $deal_start;
    $step_id->deal_end = $deal_end;
    $step_id->save();
    $deal_id=db::table('deals')
        ->join('steps','steps.deal_id','=','deals.id')
        ->select('steps.deal_id')
        ->where('steps.id','=',$id)
        ->first();
   $claimid = db::table('deals')
       ->join('claims','claims.id','=','deals.claim_id')
       ->select('claims.id')
       ->where('deals.id','=',$deal_id)
       ->first();
   dd($claimid);
       /* $claim_id = Claim::find($claimid);
        $claim_id->number = $number2;
        $claim_id->reason = $reason;
        $claim_id->save();*/
    return redirect()->action('DealsController@findone');
}
}
