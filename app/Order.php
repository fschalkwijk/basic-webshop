<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'email',
        'name',
        'address',
        'city',
        'zipcode',
    ];

    public function products(){
        return $this->belongsToMany(Product::class)
                    ->withPivot('amount', 'price_each')
                    ->withTimestamps()
                    ->withTrashed();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
