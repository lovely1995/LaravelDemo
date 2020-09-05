@extends('layouts_shop.app')
@section('content')
{!! Form::open(['action'=>'Paycontroller@store','method'=>'Post','enctype'=>'multipart/form-data']) !!}
    {!!Form::text('TotalAmount','150')!!}
    {!!Form::text('TradeDesc','cards')!!}
    {!!Form::text('ItemName','A#B')!!}
    {{Form::submit('綠界線上支付',['class'=>'btn btn-primary'])}}
{!! Form::close() !!}
{{--測試網頁--}}
@endsection