<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Order;

class OrderController extends Controller
{
    public function index(Request $request){

        $orders = Order::whereHas('client',function($q) use ($request){
            return $q->where('name','like','%'.$request->search.'%');
        })->paginate(5);

        return view('dashboard.orders.index',compact(['orders']));
    }

    public function products(Order $order){
        $products = $order->products();
        dd($products);
    }
}
