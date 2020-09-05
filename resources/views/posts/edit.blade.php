@extends('layouts_shop.app')

@section('content')
	<h1>Edit</h1>
	{{--修改輸出--}}
	{!! Form::open(['action'=>['PostController@update',$post->id],'method'=>'POST','enctype'=>'multipart/form-data']) !!}
	    <div class="form-group">
	    	{{Form::label('title','Title')}}
	    	{{Form::text('title',$post->title,['class'=>'form-control','placeholder'=>'Title'])}}
	    </div>
	    <div class="form-group">
	    	{{Form::label('price','Price')}}
	    	{{Form::number('price',$post->price,['class'=>'form-control','placeholder'=>'Price'])}}
	    </div>
	    <div class="form-group">
	    	{{Form::label('important_post','Important_post')}}
	    	{{Form::select('important_post',array('1'=>'Important','0'=>'No important'),$post->important_post)}}
	    </div>
	    <div class="form-group">
	    	{{Form::label('body','Body')}}
	    	{{Form::textarea('body',$post->body,['id'=>'article-ckeditor','class'=>'form-control','placeholder'=>'Body~'])}}
	    </div>
	    <div class="form-group">
	    	{{Form::file('cover_image')}}
	    </div>
	    {{--修改輸出--}}
	    {{Form::hidden('_method','PUT')}}
	    {{Form::submit('OK',['class'=>'btn btn-primary'])}}
	{!! Form::close() !!}
@endsection