<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Post;
use App\User;

class Searchcontroller extends Controller
{
    function index()
    {
     return view('posts.search');
    }

    function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = Post::where('title', 'like', '%'.$query.'%')
         ->orWhere('body', 'like', '%'.$query.'%')
         ->orderBy('id', 'desc')
         ->get();
      }
      else
      {
      	//$data=Post::orderBy('id','desc')->get();

      }
      $total_row = $data->count();
      if($total_row > 0)
      {
		$output .='<table class="table table-hover table-primary"><tbody>';
		$output .='<thead><tr><th scope="col">Post title</th><th scope="col">Auth</th><th scope="col">Price</th><th scope="col">Created_at</th></tr></thead>';
		foreach($data as $row)
		{
			$pid = $row->user_id;
			$user = User::find($pid);
			$output .='<tr>';
			$output .='<td><h3><a style="font-weight:bold;" href="/posts/'.$row->id.'">'.$row->title.'</a></h3></td>';
			$output .='<td><h3><a style="font-weight:bold;" href="/introduction/'.$user->id.'">'.$user->name.'</h3></a></td>';
      $output .='<td><h3><a style="font-weight:bold;">'.$row->price.'</h3></a></td>';
			$output .='<td><h3>'.$row->created_at.'</h3></td>';
			$output .='</tr>';
		}
			$output .='</tbody></table>';
      }
      else
      {
       $output = 'No Data Found';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }
}

