@extends('layouts_shop.app')
@section('content')
<h1>Carts</h1>
@if(Cart::isEmpty() )
	<h2>The shopping cart is empty</h2>
	<a href="/posts" class="btn btn-success">Go shopping</a>
@else
	<h2> {{Cart::getTotalQuantity()}} item(s) in Shopping Cart</h2>
	<hr>

@foreach(Cart::getContent() as $item)
	<div class="row align-items-center" >
			<div class="col-sm">
				<a href="storage/cover_images/{{$item->model->cover_image}}"><img style="width:100px;" src="storage/cover_images/{{$item->model->cover_image}}"></a>
			</div>
			<div class="col-sm">
				<h4><a href="/posts/{{$item->id}}">{{$item->name}}</a></h4>
			</div>
			<div class="col-sm">
				<h4>${{$item->price}}</h4>
			</div>
			<div class="col-sm">
				<h4>X{{$item->quantity}}</h4>
			</div>
			<div class="col-sm">
				<form action="{{route('carts.remove',$item->id)}}" method="post">
					{{csrf_field()}}
					{{method_field('DELETE')}}
					<button class="btn btn-danger" type="sumbit">Remove</button>
				</form>
			</div>
			<hr>
	</div>
@endforeach
	<hr>
	<h1>Total Price ${{Cart::getsubtotal()}}</h1>


	{!! Form::open(['action'=>'Paycontroller@store','method'=>'Post','enctype'=>'multipart/form-data']) !!}
		{{csrf_field()}}
	    {!!Form::hidden('TotalAmount',Cart::getsubtotal())!!}
	    {!!Form::hidden('TradeDesc','cards')!!}
	    {!!Form::hidden('Total_quantity',Cart::getTotalQuantity() )!!}
	    {!!Form::hidden('Iteminfo',ShowList( Cart::getContent() ) )!!}
	    <center>{{Form::submit('綠界線上支付',['class'=>'btn btn-primary'])}}</center>
	{!! Form::close() !!}

@endif
	

@endsection