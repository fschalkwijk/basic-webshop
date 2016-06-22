<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Cart;
use App\Product;

class CartController extends Controller
{
    public function addProduct(Request $request, Product $product, $amount=1){
        Cart::addProduct($product, $amount);

        if($request->ajax())
            return ['result' => true, 'new_product_amount' => Cart::getProductAmount($product)];
        else
            return redirect()->back();
    }

    public function removeProduct(Request $request, Product $product, $amount=null){
        Cart::removeProduct($product, $amount);

        if($request->ajax())
            return ['result' => true, 'new_product_amount' => Cart::getProductAmount($product)];
        else
            return redirect()->back();
    }
}
