@extends('layouts_shop.app')

@section('content')
<div class="row" >
	<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
	<li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
	<li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
	<li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
	</ol>
	<div class="carousel-inner">
	<div class="carousel-item active">
	<img src="storage/cover_images/b1.jpg" class="d-block w-100" alt="...">
	<div class="carousel-caption d-none d-md-block">
	<h5>First slide label</h5>
	<p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
	</div>
	</div>
	<div class="carousel-item">
	<img src="storage/cover_images/b2.jpg" class="d-block w-100" alt="...">
	<div class="carousel-caption d-none d-md-block">
	<h5>Second slide label</h5>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
	</div>
	</div>
	<div class="carousel-item">
	<img src="storage/cover_images/b3.jpg" class="d-block w-100" alt="...">
	<div class="carousel-caption d-none d-md-block">
	<h5>Third slide label</h5>
	<p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
	</div>
	</div>
	</div>
	<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
	<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
	<span class="carousel-control-next-icon" aria-hidden="true"></span>
	<span class="sr-only">Next</span>
	</a>
	</div>
</div>
<br><br>
<h1 align="center">Best product</h1>
<br>
<div class="row">
	@foreach($data_rows as $data)
		<div class="col-sm">
			<center>	
				<img class="img-thumbnail" style="width:80%;height:300px" src="storage/cover_images/{{$data->cover_image}}">
				<h2>{{$data->title}}</h2>
				<a href="/posts/{{$data->id}}" class="btn btn-primary">Read more</a>
			</center>
		</div>
	@endforeach
</div>
<br><br><br><br>





@endsection
