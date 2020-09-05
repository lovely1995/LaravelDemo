<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\Post;

class cartcontroller extends Controller
{
	public function index(){
		$row_datas=Post::inRandomorder()->take(3)->get();
		return view('carts.index')->with('row_datas',$row_datas);
	}
	public function store(Request $request)
	{	

	
		//$Post=Post::FindorFail($request->id);
		$cardtiem=Cart::add([
			'id'=>$request->id,
			'name'=>$request->title,
			'quantity'=>$request->quantity,
			'price'=>$request->price,
			'associatedModel'=>'App\Post'
		]);

		//Cart::add($request->uid,$request->title,1,$request->price)->associate('App\Post');
	


		return redirect('/carts')->with('success','Add created');
	}
	public function empty(){
		Cart::clear();
		return back()->with('success','Empty the items successfully');
	}
	public function remove($id){
		Cart::remove($id);
		return back()->with('success','romove the item successfully');
	}

}
