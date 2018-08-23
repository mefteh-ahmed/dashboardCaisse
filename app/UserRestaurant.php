<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notifications\MailResetPasswordToken;

class UserRestaurant extends Model
{
    protected  $table='users';
    protected $fillable = ['name','email','password','role','id_magasin','id_chaine'];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($token));
    }
}
