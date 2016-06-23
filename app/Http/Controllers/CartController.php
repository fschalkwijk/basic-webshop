<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Cart;
use App\Product;

class CartController extends Controller
{
    public function show(Request $request){
        $user = null;

        if(\Auth::check())
            $user = Auth::user();

        return view('cart.show', compact('user'));
    }

    public function checkout(Request $request){
        $rules = [
            'name' => 'required',
            'address' => 'required',
            'zipcode' => ['required', 'regex:'.config('regex.zipcode')],
            'city' => 'required',
            'bank'  => 'required|integer|in:1001,1005,1009',
        ];

        if(!\Auth::check()){
            $rules['email'] = 'required|email|unique:users,email';
            $rules['password'] = ['confirmed', 'regex:'.config('regex.password')];
        }

        $this->validate($request, $rules);

        $order = Cart::save($request->all());

        if(\Auth::check()){
            $user = Auth::user()
                    ->fill($request->data->except('password', 'email'))
                    ->save();

            $order->user_id = $user->id;
        }

        return redirect()->action('HomeController@index'); //Change this to OrderController@show after I made this
    }

    public function addProduct(Request $request, Product $product, $amount=1){
        Cart::addProduct($product, $amount);

        if($request->ajax())
            return ['result' => true] + Cart::toArray();
        else
            return redirect()->back();
    }

    public function removeProduct(Request $request, Product $product, $amount=null){
        Cart::removeProduct($product, $amount);

        if($request->ajax())
            return ['result' => true] + Cart::toArray();
        else
            return redirect()->back();
    }
}
