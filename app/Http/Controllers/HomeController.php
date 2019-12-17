<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Profile;
use App\Address;
use App\Phone;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    if(Auth::user()->role == 'member')
      {
            return redirect('/member/home');
        }
        elseif(Auth::user()->role == 'user') {


            $id = Auth::user()->id;
            $profile = Profile::where('user_id', $id)
                ->join('addresses', 'addresses.object_id', '=', 'profiles.user_id')
                ->join('phones', 'phones.object_id', '=', 'profiles.user_id')
                ->select('phones.*', 'profiles.*', 'addresses.*')
                ->getQuery()
                ->first();

            return view('home', [
                'profile' => $profile,
            ]);
        }
    }
    public function adminhome(){
        return view('admin\home');
    }

    public function insertdata(Request $req)
    {
        $name = $req->input('name');
        $date_of_birth = $req->input('date_of_birth');
        $phone = $req->input('phone');
        $index = $req->input('index');
        $place = $req->input('place');
        $street = $req->input('street');
        $street_number = $req->input('street_number');
        $flat = $req->input('flat');
        $user_id = Auth::user()->id;
        $object_id = Auth::user()->id;
        $created_at = Carbon::now();
        $updated_at = Carbon::now();
        $object_type = 'users';
        //$data = array('name'=>$name,'date_of_birth'=>$date_of_birth,'user_id'=>$user_id, $created_at,$updated_at);
        $data1 = array('object_id'=>$object_id,'object_type'=>$object_type,'phone'=>$phone,'created_at'=>$created_at, 'updated_at'=>$updated_at);
        $data2 = array('object_id'=>$object_id,'object_type'=>$object_type,'index'=>$index,'place'=>$place,'street'=>$street,'street_number'=>$street_number,'flat'=> $flat, 'created_at'=>$created_at, 'updated_at'=>$updated_at);
        //DB::table('profiles')->insert($data);
        DB::table('phones')->insert($data1);
        DB::table('addresses')->insert($data2);
       $profiles = Profile::create([
           'name'=>$name,
           'date_of_birth'=>$date_of_birth,
           'user_id'=>$user_id,
           'created_at'=>$created_at,
           'updated_at'=>$updated_at




       ]);
       $user = User::find($user_id);
        $user->profile()->save($profiles);
        $id=Auth::user()->id;
        $profile=Profile::where('user_id',$id)
            ->join('addresses','addresses.object_id','=','profiles.user_id')
            ->join('phones', 'phones.object_id', '=', 'profiles.user_id')
            ->select('phones.*','profiles.*','addresses.*')
            ->getQuery()
            ->first();
       // return redirect()->back()->withSuccess('IT WORKS!');
        return view('home',[
            'profile'=>$profile
        ]);
    }
    public function session(Request $request)
    {
        $ww = db::table('users')->where('role','member')->get();
        $request->session()->put('key', $ww);
        $value = session('key');
        return view('admin.dd',['l'=>$value]);
    }
}
