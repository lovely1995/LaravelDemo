@extends('layouts_shop.app')
@section('content')
	<div class="row">
		<div class="col-sm-3 card padding p-3">
			{{--透過link取出--}}
			<center>
				<img style="width:80%" class="img-thumbnail" src="/storage/user_images/{{$User_info->user_image}}">
				<br><br>
				<h3>{{$User_info->user->name}}</h3>
				<h4>{{$User_info->sign}}</h4>
				@if(!Auth::guest())
					@if(Auth::user()->id == $User_info->id)
						<a href="/introduction/{{$User_info->id}}/edit" class="btn btn-info">Edit</a>
					@endif
				@endif
			</center>

		</div>
		<div align="center" class="col-sm-9">
			<h3>Introduction</h3>
			<div class="jumbotron jumbotron-fluid">
			  <div class="container">
			    <p class="lead">{!!$User_info->introduction!!}</p>
			  </div>
			</div>
		</div>
	</div>

@endsection