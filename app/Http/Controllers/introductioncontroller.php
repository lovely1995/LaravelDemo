<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\User_info;
use App\User;
use DB;

class introductioncontroller extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
        //允許進去的頁面
        $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $Users_info= User_info::orderby('id','desc')->paginate(10);
        return view('profile.index')->with('Users_info',$Users_info);
    }




    public function show($id)
    {
        //$user_id=auth()->user()->id;//get auth/user/id
        $user = User_info::find($id);
        return view('profile.introduction')->with('User_info',$user);
    }
    public function edit($id)
    {
        $User_info=User_info::find($id);
        if(auth()->user()->id !== $User_info->id){
            return redirect('/introduction')->with('error','unauthorized page');
        }   
            return view('profile.edit')->with('User_info',$User_info);

    }
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'sex' => 'required',
            'sign' => 'required',
            'introduction' => 'required'
        ]);

        //upload image
        if ($request->hasFile('user_image')){
            //all name
            $getfile=$request->file('user_image')->getClientOriginalName();
            //file name
            $file_name=pathinfo($getfile,PATHINFO_FILENAME);
            //extension
            $sec_file_name=$request->file('user_image')->getClientOriginalExtension();
            //name save as
            $FileNameStore=$file_name.'_'.time().'.'.$sec_file_name;
            //save to original path
            $path=$request->file('user_image')->storeAS('public/user_images',$FileNameStore);

        }
        //users_info
        $users_info=User_info::find($id);
        $users_info->sex=$request->input('sex');
        $users_info->introduction=$request->input('introduction');
        $users_info->sign=$request->input('sign');
        //fi upload use or no use
        if($request->hasFile('user_image')){
            $users_info->user_image=$FileNameStore;
        }
        $users_info->save();

        return redirect('/introduction/'.$id)->with('success','upload profile');

    }
}
