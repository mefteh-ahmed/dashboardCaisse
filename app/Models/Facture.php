<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facture extends Model {
    
    
    protected $table = 'facture';
    // protected $primaryKey = 'FACT_Num';
    //public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        // 'PRO_code', 'PRO_prix', 'PRO_desg'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token', 'ip_address',
    // ];
    

}
