<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'city',
        'zipcode',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
