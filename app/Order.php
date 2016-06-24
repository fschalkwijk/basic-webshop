<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Scopes\OwnerScope;

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

    public static function boot(){
        parent::boot();

        static::addGlobalScope(new OwnerScope);
    }

    public function products(){
        return $this->belongsToMany(Product::class)
                    ->withPivot('amount', 'price_each')
                    ->withTimestamps()
                    ->withTrashed();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getTotalPriceAttribute(){
        return $this->products->sum(function($product){
            return $product->pivot->amount * $product->pivot->price_each;
        });
    }

    public function getProductAmountAttribute(){
        return $this->products->sum('pivot.amount');
    }

    public function getTotalVatAttribute(){
        return $this->products->sum(function($product){
            return $product->pivot->amount * $product->pivot->vat_percentage;
        });
    }
}
