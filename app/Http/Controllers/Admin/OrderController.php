<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function allOrders()
    {
        $order = Order::latest()->get();
        return view('admin.order.all_order', compact('order'));
    }

    public function deleteOrders($id)
    {
        $order = Order::find($id);
        $order->delete();
        if ($order) {
            toast('Berhasil Menghapus data!', 'success')->timerProgressBar();
            return Redirect()->route("orders.all")->with(['delete' => 'Product deleted successfully']);
        }
    }
}
