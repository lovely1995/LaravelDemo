<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//add user function
use App\User;
use App\User_info;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //阻擋直接連結
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //user and id relationship
        $user_id=auth()->user()->id;//get auth/user/id
        //找出id
        $user=User::find($user_id);
        return  view('dashboard')->with('posts',$user->posts);
    }
}
