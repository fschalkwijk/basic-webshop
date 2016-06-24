<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Order;

class OrderController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $items = Order::orderBy('created_at', 'desc')->get();

        return view('order.index', compact('items'));
    }

    public function show(Order $item){
        return view('order.show', compact('item'));
    }
}
