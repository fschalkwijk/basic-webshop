<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    public function products(){
        return $this->belongsToMany(Order::class)
                    ->withPivot('amount', 'price_each')
                    ->withTimestamps();
    }

    public function getVatAttribute(){
        return $this->price * $this->vat_percentage;
    }
}
