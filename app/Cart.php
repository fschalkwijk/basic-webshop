<?php

namespace App;

use Session;

class Cart{
    const SESSION_KEY = '_cart';

    /**
     * Items in the cart
     * @var [product_id integer => $cart_item App\CartItem]
     */
    protected $items;

    /**
     * Calculated totals are stored here to prevent calculating the same values multiple times
     * @var [total_name string => value mixed]
     */
    protected $totals;

    /**
     * Construct a Cart instance
     * Start by loading previous data from the session
     */
    public function __construct(){
        $this->unserialize();
    }

    public function addProduct(Product $product, $amount=1){
        if($this->items->has($product->id))
            $this->items[$product->id]->addAmount($amount);
        else
            $this->items->put($product->id, new CartItem($product, $amount));

        $this->clearTotals();

        return $this;
    }

    public function removeProduct(Product $product, $amount=null){
        if(!$this->items->has($product->id))
            return;

        if(!$amount !== null)
            $this->items[$product->id]->lowerAmount($amount);
        else
            $this->items[$product->id]->setAmount(0);

        $this->clearTotals();

        return $this;
    }

    public function setProductAmount(Product $product, $amount){
        if(!$this->items->has($product->id))
            return $this->addProduct($product, $amount);

        $this->items[$product->id]->setAmount($amount);

        $this->clearTotals();

        return $this;
    }

    public function getProductAmount(Product $product){
        if(!$this->items->has($product->id))
            return 0;

        return $this->items[$product->id]->amount;
    }

    public function has(Product $product){
        return $this->items->has($product->id);
    }

    public function clear(){
        $this->items = collect([]);

        $this->clearTotals();

        return $this;
    }

    public function getTotalPrice(){
        if(!isset($this->totals['total_price'])){
            $this->totals['total_price'] = $this->items->sum(function(CartItem $cart_item){
                return $cart_item->getAmount() * $cart_item->getProduct()->price;
            });
        }

        return $this->totals['total_price'];
    }

    public function getTotalVat(){
        if(!isset($this->totals['total_vat'])){
            $this->totals['total_vat'] = $this->items->sum(function(CartItem $cart_item){
                return $cart_item->getAmount() * $cart_item->getProduct()->vat;
            });
        }

        return $this->totals['total_vat'];
    }

    public function getTotalProductAmount(){
        if(!isset($this->totals['total_products'])){
            $this->totals['total_products'] = $this->items->sum(function($item){
                return $item->amount;
            });
        }

        return $this->totals['total_products'];
    }

    protected function calculateTotals(){
        $this->getTotalPrice();
        $this->getTotalVat();
        $this->getTotalProductAmount();

        return $this;
    }

    protected function clearTotals(){
        $this->totals = [];

        return $this;
    }

    public function getItems(){
        return collect($this->items);
    }

    public function toArray(){
        $items = [];
        foreach($this->items as $cart_item)
            $items[$cart_item->product->id] = [
                'amount' => $cart_item->amount,
                'product' => $cart_item->product->toArray(),
            ];

        $this->calculateTotals();

        return $this->totals + compact('items');
    }

    public function serialize(){
        $items = [];
        foreach($this->items as $cart_item)
            $items[$cart_item->product->id] = $cart_item->amount;

        Session::set(static::SESSION_KEY, [
            'cart_items'    => $items,
            'totals'        => $this->totals,
        ]);

        return $this;
    }

    public function unserialize(){
        $data = Session::get(static::SESSION_KEY, []);

        $this->clear();

        if(!empty($data)){
            $this->totals = $data['totals'];

            $products = Product::whereIn('id', array_keys($data['cart_items']))->get()->keyBy('id');

            foreach($data['cart_items'] as $product_id => $amount)
                if($products->has($product_id))
                    $this->addProduct($products->get($product_id), $amount);
        }
    }

    public function save(array $order_data){
        $order = Order::create($order_data);

        $this->removeProductsWithZeroAmount();

        $order_lines = $this->items
                            ->map(function($cart_item){
                                return [
                                    'amount'        => $cart_item->amount,
                                    'price_each'    => $cart_item->product->price,
                                    'vat_percentage'=> $cart_item->product->vat_percentage
                                ];
                            })->toArray();

        $order->products()->sync($order_lines);

        $this->clear();

        return $order;
    }

    public function removeProductsWithZeroAmount(){
        $this->items = $this->items->reject(function($item){
            return $item->amount == 0;
        });
    }

    public function print_r(){
        echo '<pre>';
        print_r($this->items);
        echo '</pre>';

        echo '<pre>';
        print_r($this->totals);
        echo '</pre>';
    }
}
