@extends('layouts_shop.app')

@section('content')
	<a href="/posts" class="btn btn-info">Back</a>
	<div class="row align-items-center">
		<div class="col-sm">
			<p><img style="width:300px" src="/storage/cover_images/{{$post->cover_image}}"></p>
		</div>
		<div class="col-sm">
			<h1>{{$post->title}}</h1>
			<small>created_at:{{$post->created_at}}</small>
			<br>
			<small>updated_at:{{$post->updated_at}}</small>
			<br><br>
			<h4>{!!$post->body!!}</h4>
			<h2>$ {{$post->price}}</h2>
			<form action="{{route('carts.store')}}" method="POST">
				{{csrf_field()}}
				<input type="hidden" name="id" value="{{$post->id}}">
				<input type="hidden" name="title" value="{{$post->title}}">
				<input type="hidden" name="price" value="{{$post->price}}">
				<input type="number" name="quantity" value="1">
				<button class="btn btn-success" type="sumbit">Add the shopping cart</button>
			</form>
		</div>
	</div>
	<!--檢查用戶-->
	@if(!Auth::guest())
		<!--login userid == post userid-->
		@if(Auth::user()->id == $post->user_id)
			<a href="/posts/{{$post->id}}/edit" class="btn btn-info">Edit</a>
			{{--DEL DATA--}}
			{!!Form::open(['action'=>['PostController@destroy',$post->id],'method'=>'POST','class'=>'float-right'])!!}
				{{Form::hidden('_method','DELETE')}}
				{{Form::submit( 'DELETE',['class'=>'btn btn-danger'] ) }}
			{!!Form::close()!!}
		@endif
	@endif
@endsection