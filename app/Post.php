<?php
/**
//產生此頁面
php artisan make:model Post -m
//建立資料表
php artisan migrate
//sql add data
php artisan tinker
$post= new App\Post();
$post->'title'='any';
$post->save();
**/

namespace App;

use Illuminate\Database\Eloquent\Model;
//class + table name
class Post extends Model
{
    //Table Name 如果post不是table name 才需要這行
    protected $table = 'posts';
    //primary key
    public $primaryKey = 'id';
    public $timestamps = true ;


    public function user(){
    	//取得擁有post的user
    	return $this->belongsTo('App\User');
    }

}
