<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRestaurant extends Model
{
    protected  $table='users';
    protected $fillable = ['name','email','password','id_magasin','role'];}
