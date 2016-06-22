<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function products(){
        return $this->hasMany(Order::class)
                    ->withPivot('amount', 'price_each')
                    ->withTimestamps();
    }

    public function getVatAttribute(){
        return $this->price * $this->vat_percentage;
    }
}
