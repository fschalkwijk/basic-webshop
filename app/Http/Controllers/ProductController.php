<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Product;

class ProductController extends Controller
{
    public function show(Product $item){
        return view('product.show', compact('item'));
    }
}
