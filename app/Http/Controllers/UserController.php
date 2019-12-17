<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Claim;
use Auth;
use App\User;
use Illuminate\Support\Carbon;
use Alert;


class UserController extends Controller
{
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

        return view('users.claim');
    }

    public function profile(){
        return view('users.profile');
    }

}
