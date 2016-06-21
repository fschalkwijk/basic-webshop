<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    public function products(){
        return $this->hasMany(Product::class)
                    ->withPivot('amount', 'price_each')
                    ->withTimestamps()
                    ->withTrashed();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
