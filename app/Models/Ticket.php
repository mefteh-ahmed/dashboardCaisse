<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Ticket extends Model {
    
 

    protected $table = 'Ticket';
    // protected $primaryKey = ['TIK_NumTicket','TIK_Exerc','TIK_IdCarnet'];
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
