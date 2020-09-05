<?php

use Illuminate\Support\Facades\Route;

/*
Route::get('/', function () {
    //return view('welcome');
    return 'hi';
});
Route::get('/users/{id}/{name}',function($id,$name){
	return 'This is '.$id.' Name:'.$name ;
});
*/



//頁面管理
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');
//函式管理
Route::resource('posts', 'PostController');
//personal_file   resource取得底下所有public  get指定某個public
Route::resource('/introduction','introductioncontroller');
Auth::routes();
//article
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
//ajax search
Route::get('/search','Searchcontroller@index');
//arction public
Route::get('/search/action','Searchcontroller@action')->name('search.action');
//pay
Route::get('/pay','Paycontroller@index');
Route::post('/payout','Paycontroller@store')->name('pay.store');
//cart
Route::get('/carts','cartcontroller@index')->name('carts.index');
Route::post('/carts','cartcontroller@store')->name('carts.store');
Route::get('/empty','cartcontroller@empty')->name('carts.empty');

Route::delete('/carts/{Post}','cartcontroller@remove')->name('carts.remove');



