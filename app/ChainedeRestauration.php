<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChainedeRestauration extends Model
{
    protected  $table='chaine_restauration';
    protected $fillable = ['nom_chaine','Fondateur','Mail','telephone'];

}
