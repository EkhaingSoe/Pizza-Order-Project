<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function orderList(){
        $data = Order::select('orders.*','users.name as customer_name','pizzas.pizza_name as pizza_name',DB::raw(value: 'COUNT(orders.pizza_id) as count'))
                ->join('users','orders.customer_id','users.id')
                ->join('pizzas','orders.pizza_id','pizzas.pizza_id')
                ->groupBy('orders.customer_id','orders.pizza_id')
                ->get();

        return view('admin.order.orderList')->with(['order'=>$data]);
    }
}
