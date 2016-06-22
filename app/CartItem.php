<?php

namespace App;

use App\Exceptions\CartException;

class CartItem{
    protected $product;

    protected $amount;

    public function __construct(Product $product, $amount){
        $this->setProduct($product);
        $this->setAmount($amount);
    }

    public function getProduct(){
        return $this->product;
    }

    protected function setProduct(Product $product){
        if(!$product->exists())
            throw new CartException("Only existing products can be added to the cart");

        $this->product = $product;

        return $this;
    }

    public function getAmount(){
        return $this->amount;
    }

    public function setAmount($amount){
        if($amount < 0)
            $amount = 0;

        $this->amount = $amount;

        return $this;
    }

    public function addAmount($amount){
        $this->amount += $amount;

        return $this;
    }

    public function lowerAmount($amount){
        $this->amount -= $amount;

        if($this->amount < 0)
            $this->amount = 0;

        return $this;
    }

    public function __get($property){
        switch($property){
            case 'product':
                return $this->getProduct();
            case 'amount':
                return $this->getAmount();
            default:
                $trace = debug_backtrace();
                trigger_error(
                    'Undefined property via __get(): ' . $property .
                    ' in ' . $trace[0]['file'] .
                    ' on line ' . $trace[0]['line'],
                    E_USER_NOTICE);
                return null;
        }
    }

    public function __set($property, $value){
        switch($property){
            case 'product':
                return $this->setProduct($value);
            case 'amount':
                return $this->setAmount($value);
            default:
                $trace = debug_backtrace();
                trigger_error(
                    'Undefined property via __set(): ' . $property .
                    ' in ' . $trace[0]['file'] .
                    ' on line ' . $trace[0]['line'],
                    E_USER_NOTICE);
                return null;
        }
    }
}
