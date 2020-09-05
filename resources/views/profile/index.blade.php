@extends('layouts_shop.app')

@section('content')



@foreach($Users_info as $User_info)
	<img style="width:10%" src="/storage/user_images/{{$User_info->user_image}}">
	<a href="introduction/{{$User_info->id}}"><p>{{$User_info->user->name}}</p></a>
@endforeach


@endsection