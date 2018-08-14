<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RestaurantDataBase extends Model
{
    protected  $table='dbrestaurant';
    protected $fillable = ['DB_HOST','DB_DATABASE','DB_USERNAME','DB_PASSWORD','id_magasin'];
}
