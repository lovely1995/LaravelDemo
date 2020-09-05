<?php
//建立AIP此頁面 php artisan make:controller Postcontroller --resource
//查詢所有API php artisan rout:list
namespace App\Http\Controllers;
use Illuminate\Http\Request;
//storage action
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;
class Postcontroller extends Controller
{

    //阻擋直接連結
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
        //$posts= Post::all();
        //$posts = DB:: sql.....;
        //$posts= Post::orderby('id','desc')->take(2)->get();
        //$posts= Post::orderby('id','desc')->get();
        $posts= Post::orderby('id','desc')->paginate(5);
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' =>'required',
            'body' => 'required',
            'important_post' => 'required',
            'price' => 'required', 
            'cover_image' => 'image|nullable|max:1999'//alt+124
        ]);

        //file upload
        if($request->hasFile('cover_image')){
            $fileNameWithExt=$request->file('cover_image')->getClientOriginalName();
            //get name
            $filename=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //get 副檔名
            $extension=$request->file('cover_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            //upload NOTE! controller path is from link
            $path= $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }else{
            $fileNameToStore='noimage.jpg';
        }

        //create post
        $post= new post;
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        $post->important_post=$request->input('important_post');
        $post->price=$request->input('price');
        $post->user_id=auth()->user()->id;
        $post->cover_image=$fileNameToStore;
        $post->save();




        return redirect('/posts')->with('success','Post created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        //check user id
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','unauthorized page');
        }
        return view('posts.edit')->with('post',$post);

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' =>'required',
            'body' => 'required',
            'price' => 'required',
            'important_post' => 'required'
        ]);

        //file upload
        if($request->hasFile('cover_image')){
            $fileNameWithExt=$request->file('cover_image')->getClientOriginalName();
            //get name
            $filename=pathinfo($fileNameWithExt,PATHINFO_FILENAME);
            //get 副檔名
            $extension=$request->file('cover_image')->getClientOriginalExtension();
            //filename to store
            $fileNameToStore=$filename.'_'.time().'.'.$extension;
            //upload   NOTE! controller path is from link
            $path= $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }

        $post= post::find($id);
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        $post->important_post=$request->input('important_post');
        $post->price=$request->input('price');
        if($request->hasFile('cover_image')){
            $post->cover_image=$fileNameToStore;
        }
 
        $post->save();

        return redirect('/posts')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        //check user id
        if(auth()->user()->id !==$post->user_id){
            return redirect('/posts')->with('error','unauthorized page');
        }

        if($post->cover_image != 'noimage.jpg'){
            //NOTE! controller path is from link
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success','Remove success');
    }

}
