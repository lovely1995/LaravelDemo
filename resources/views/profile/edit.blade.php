@extends('layouts_shop.app')

@section('content')
	{{ Form::open(['action'=>['introductioncontroller@update',$User_info->id],'method'=>'POST','enctype'=>'multipart/form-data']) }}
	    <div class="form-group">
	    	{{Form::Label('','Sign')}}
	    	{{Form::text('sign',$User_info->sign,['class'=>'form-control','placeholder'=>'Sign'])}}
	    </div>
	    <div class="form-group">
	    	{{Form::label('','Sex')}}
	    	{{Form::select('sex',array('girl'=>'girl','Boy'=>'Boy','hidden'=>'hidden'),$User_info->sex)}}
	    </div>
	    <div class="form-group">
	    	{{Form::Label('introduction','Introduction')}}
	    	{{Form::textarea('introduction',$User_info->introduction,['id'=>'article-ckeditor','class','form-control','placeholder'=>'introduction'])}}
	    </div>
	    <div class="form-group">
	    	{{Form::label('','User Image')}}
	    	{{Form::file('user_image')}}
	    	
	    </div>
	    {{Form::hidden('_method','PUT')}}
	    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
	{{ Form::close() }}
@endsection