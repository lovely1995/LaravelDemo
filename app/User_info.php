<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_info extends Model
{
    protected $table = 'Users_info';
    public $primaryKey = 'id';
    public $timestamps = true ;

    public function user(){
    	//其餘資料表 onehas 後面要加指定目標欄位 用id配對
    	return $this->belongsTo('App\User','id');
    }
}
