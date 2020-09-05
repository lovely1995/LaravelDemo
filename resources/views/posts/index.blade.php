

@extends('layouts_shop.app')

@section('content')
	<h1 align="center">Blog Posts</h1>
	<br>
	<h3>#Specific</h3>
	<table class="table table-hover" style="background-color:white;">
		<tbody>
		@foreach($posts as $post)
			<tr>
				@if($post->important_post==1)
				<td>
					<div class="row align-items-center">
						<div class="col-sm-3">
							<img  class="img_chcolor" style="width:80%"  src="/storage/cover_images/{{$post->cover_image}}">
						</div>
						<div class="col-sm-5">
							<br>
							<h5><a class="font_title" href="/posts/{{$post->id}}">{{$post->title}}</a></h5>
							<p>{!!$post->body!!}</p>
						</div>
						<div class="col-sm">
							<h5>${{$post->price}}</h5>
						</div>
						<div class="col-sm-3">
							<h5 align="center"><a href="introduction/{{$post->user_id}}" style="color:green">{{$post->user->name}}</a></h5>
							<p align="center">Wriiten on{{$post->created_at}}</p>
						</div>
					</div>
				</td>
				@endif
			</tr>
		@endforeach
		</tbody>
	</table>
	<br>
	<h3>#Photo</h3>
	<table class="table table-hover" style="background-color:white;">
		<tbody>
		@foreach($posts as $post)
			<tr>
				@if($post->important_post==0)
				<td>
					<div class="row align-items-center">
						<div class="col-sm-3">
							<img class="img_chcolor" style="width:80%"  src="/storage/cover_images/{{$post->cover_image}}">
						</div>
						<div class="col-sm-5">
							<br>
							<h5><a class="font_title" href="/posts/{{$post->id}}">{{$post->title}}</a></h5>
							<p>{!!$post->body!!}</p>
						</div>
						<div class="col-sm">
							<h5>${{$post->price}}</h5>
						</div>
						<div class="col-sm-3">
							<br><br><br><br>
							<h5 align="center"><a href="introduction/{{$post->user_id}}" style="color:green">{{$post->user->name}}</a></h5>
							<p align="center">Wriiten on{{$post->created_at}}</p>
						</div>
					</div>
				</td>
				@endif
			</tr>
		@endforeach
		</tbody>
	</table>
	{{$posts->links()}}

@endsection