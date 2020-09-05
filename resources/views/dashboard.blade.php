@extends('layouts_shop.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>


                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>


                    @endif
                    <div class="row">
                        <div class="col-sm-10">
                            {{ __('You are logged in!') }}
                        </div>
                        <div class="col-sm">
                                <a href="/posts/create" class="btn btn-success">create</a>
                        </div>
                    </div>
                    <center><h3>Hi!  {{Auth::user()->name}}, Your blog</h3></center>
                    @if(count($posts)>0)
                    <table class="table table-striped">
                    <tr>
                        Article Title
                    </tr>
                        @foreach ($posts as $post)
                            <tr>
                                <td>
                                    <a href="/posts/{{$post->id}}">{{$post->title}}</a>
                                    <br>
                                    <small>{{$post->created_at}}</small>
                                </td>
                                <td><a href="/posts/{{$post->id}}/edit" class="btn btn-primary">Edit</a></td>
                                <td>
                                {{--DEL DATA--}}
                                {!!Form::open(['action'=>['PostController@destroy',$post->id],'method'=>'POST','class'=>'float-right'])!!}
                                    {{Form::hidden('_method','DELETE')}}
                                    {{Form::submit( 'DELETE',['class'=>'btn btn-danger'] ) }}
                                {!!Form::close()!!}
                                </td>
                            </tr>
                        @endforeach

                    </table>
                    @else
                        <p>No posts</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
