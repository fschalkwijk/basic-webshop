<?php

namespace App;

use App\Exceptions\CartException;

/**
 * Item in the Cart.
 *
 * Holds one \App\Product in the cart with the added amount.
 */
class CartItem{
    /**
     * Product this CartItem contains.
     *
     * @var \App\Product
     */
    protected $product;

    /**
     * Amount of $this->product in this CartItem.
     *
     * @var Integer
     */
    protected $amount;

    /**
     * Creates a new CartItem for $amount $product.
     *
     * @param  Product $product [description]
     * @param  [type]  $amount  [description]
     * @return $this
     */
    public function __construct(Product $product, $amount){
        $this->setProduct($product);
        $this->setAmount($amount);
    }

    /**
     * Return the Product in this CartItem
     *
     * @return \App\Product
     */
    public function getProduct(){
        return $this->product;
    }

    /**
     * Set the Product in this CartItem.
     *
     * Prevents not existing products from entering the cart.
     *
     * @param  \App\Product $product
     * @return $this
     */
    protected function setProduct(Product $product){
        if(!$product->exists())
            throw new CartException("Only existing products can be added to the cart");

        $this->product = $product;

        return $this;
    }

    /**
     * Return the amount of products in this CartItem.
     *
     * @return integer
     */
    public function getAmount(){
        return $this->amount;
    }

    /**
     * Sets the amount of $product in this CartItem.
     *
     * Prevents negative amounts.
     *
     * @param  integer $amount
     * @return $this
     */
    public function setAmount($amount){
        if($amount < 0)
            $amount = 0;

        $this->amount = $amount;

        return $this;
    }

    /**
     * Add $amount to this CartItem.
     *
     * @param  integer $amount
     * @return $this
     */
    public function addAmount($amount){
        $this->amount += $amount;

        return $this;
    }

    /**
     * Lower the amount in this CartItem by $amount to a minimun of 0.
     *
     * @param  integer $amount
     * @return $this
     */
    public function lowerAmount($amount){
        $this->amount -= $amount;

        if($this->amount < 0)
            $this->amount = 0;

        return $this;
    }

    /**
     * Magicly gets the product and amount properties of this CartItem through the get functions.
     *
     * @param  string $property Property name
     * @return \App\Product|integer
     */
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

    /**
     * Magicly sets the product and amount properties of this CartItem through the set functions.
     *
     * @param  string $property Property name
     * @return $this
     */
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
