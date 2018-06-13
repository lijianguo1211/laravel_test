<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\Mail\OrderShipped;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function ship(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        // 处理订单...

        Mail::to($request->user())->send(new OrderShipped($order));
    }
}
