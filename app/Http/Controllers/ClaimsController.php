<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\Claim;
use App\User;
use App\Profile;
use App\Phone;
use App\Address;

class ClaimsController extends Controller
{
    public function index()
    {

        return view('users.claim');
    }
    public function insert(Request $req)
    {

        $reason = $req->input('reason');
        $user_id = Auth::user()->id;
        $created_at = Carbon::now();
        $updated_at = Carbon::now();
        $claims = Claim::create([
            'reason'=>$reason,
            'user_id'=>$user_id,
            'created_at'=>$created_at,
            'updated_at'=>$updated_at


        ]);
        $user = User::find($user_id);
        $user->claims()->save($claims);
        $id=Auth::user()->id;
        $profile = Profile::join('phones', 'phones.object_id', '=', 'profiles.id')
            ->join('addresses', 'addresses.object_id', '=', 'profiles.id')
            ->where('profiles.user_id',$id)
            ->select('profiles.*', 'addresses.*', 'phones.phone')
            ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
            ->first();
        $id=Auth::user()->id;
        $profile=Profile::where('user_id',$id)
            ->join('addresses','addresses.object_id','=','profiles.user_id')
            ->join('phones', 'phones.object_id', '=', 'profiles.user_id')
            ->select('phones.*','profiles.*','addresses.*')
            ->getQuery()
            ->first();
        //return redirect()->action('HomeController@index');
        return view('home2',['profile'=>$profile]);
    }
    public function adminclaims()
    {
        $oneclaims = db::select("SELECT claims.id,claims.number,claims.reason,users.name,users.email,profiles.name,
        phones.phone,addresses.index,addresses.place,addresses.street,addresses.street_number,addresses.flat 
        FROM `claims` 
        INNER JOIN users ON users.id=claims.user_id 
        INNER JOIN profiles ON profiles.user_id = users.id 
        INNER JOIN phones on phones.object_id = profiles.user_id 
        INNER JOIN addresses on addresses.object_id =profiles.user_id ORDER BY `ID` ASC;");
        return view('admin.claims', [
            'oneclaims'=>$oneclaims


        ]);

    }
    public function editclaim($id,Request $request)
    {
        $profile = Profile::find($id);
        $profile->name = $request->get('name');
        $profile->date_of_birth=$request->get('date_of_birth');
        $profile->updated_at = Carbon::now();
        $profile->save();
        $phone= Phone::find($id);
        $phone->phone = $request->get('phone');
        $phone->save();
        $address=Address::find($id);
        $address->index=$request->get('index');
        $address->place=$request->get('place');
        $address->street=$request->get('street');
        $address->street_number=$request->get('street_number');
        $address->flat=$request->get('flat');
        $address->save();
        return redirect()->action('HomeController@index');

    }
    public function adminclaim(Request $req, $id)
    {
        $claims = Claim::find($id);
        $claims->number = $req->input('number');
        $claims->save();
        return redirect('/admin/claims');


    }
    public function get()
    {
        $id=Auth::user()->id;
        $profile = Profile::join('phones', 'phones.object_id', '=', 'profiles.id')
            ->join('addresses', 'addresses.object_id', '=', 'profiles.id')
            ->where('profiles.user_id',$id)
            ->select('profiles.*', 'addresses.*', 'phones.phone')
            ->getQuery() // Optional: downgrade to non-eloquent builder so we don't build invalid User objects.
            ->first();
        return view('home2',[
            'profile'=>$profile,
        ]);
    }
    public function allclaims()
    {
        return view('admin.claims');
    }
   /* public function filter(Request $request)
    {
        if($request->ajax())
        {
            if($request->from_date != '')
            {
                if($request->from_date=='with_number'){
                   /* $dat = DB::table('claims')
                        ->select('claims.id as id')
                        ->join('users','user.id','=','claims.user_id')
                        ->join('profiles','profiles.user_id','=','users.id')
                        ->where('claims.number','!=',NULL)
                        ->select('claims.id as id','profiles.name','users.email','claims.reason')
                        ->get();*/
              //  }
              //  else if($request->from_date=='without_number'){
                    /*$dat = DB::table('claims')
                        ->select('claims.id as id')
                        ->join('users','user.id','=','claims.user_id')
                        ->join('profiles','profiles.user_id','=','users.id')
                        ->where('claims.number','=',NULL)
                        ->select('claims.id as id','profiles.name','users.email','claims.reason')
                        ->get();*/
          //      }
          //  }
         //   else
         //   {
                /*$dat = DB::table('claims')
                    ->select('claims.id as id')
                    ->join('users','user.id','=','claims.user_id')
                    ->join('profiles','profiles.user_id','=','users.id')
                    ->select('claims.id as id','profiles.name','users.email','claims.reason')
                    ->get();*/
         //   }
           // echo json_encode($dat);
       //}
  //  }

}
