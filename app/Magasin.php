<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Magasin extends Model
{
    protected  $table='magasin';
    protected $fillable = ['nom','adresse','Telphone','email'];
}
