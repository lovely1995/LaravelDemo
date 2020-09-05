@extends('layouts_shop.app')

@section('content')
	<h1>Create</h1>
	{!! Form::open(['action'=>'PostController@store','method'=>'Post','enctype'=>'multipart/form-data']) !!}
	    <div class="form-group">
	    	{{Form::label('title','Title')}}
	    	{{Form::text('title','',['class'=>'form-control','placeholder'=>'Title'])}}
	    </div>
	    <div class="form-group">
	    	{{Form::label('price','Price')}}
	    	{{Form::number('price','',['class'=>'form-control','placeholder'=>'Price'])}}
	    </div>
	    <div class="form-group">
	    	{{Form::label('important_post','Important_post')}}
	    	{{Form::select('important_post',array('1'=>'Important','0'=>'No important'),'0')}}
	    </div>
	    <div class="form-group">
	    	{{Form::label('body','Body')}}
	    	{{Form::textarea('body','',['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Body'])}}
	    </div>
	    <div class="form-group">
	    	{{Form::file('cover_image')}}
	    </div>
	    {{Form::submit('OK',['class'=>'btn btn-primary'])}}
	{!! Form::close() !!}
@endsection