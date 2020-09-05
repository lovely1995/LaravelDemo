<?php

namespace App\Http\Controllers;
use App\Post;
use Illuminate\Http\Request;

class PagesController extends Controller
{
	public function index(){
		
		$data_rows=Post::inRandomorder()->take(3)->get();
		return view('app_view.index')->with('data_rows',$data_rows);
	}
	public function about(){
		$title='About';
		return view('app_view.about')->with('title',$title);
	}
	public function services(){
		$ar=array(
			'title'=>'Services~',
			'services'=>['WEB','ARE','AOE']
		);
		return view('app_view.services')->with($ar);
	}

}
