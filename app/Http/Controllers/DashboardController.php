<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function __invoke(Request $request): View
    {
        $total_users    = User::count() + Customer::count();
        $total_products = Product::count();

        $orders                 = Order::all();
        $total_delivered_orders = $orders->where('is_delivered', 1)->count();
        $total_pending_orders   = $orders->count() - $total_delivered_orders;

        $admins = User::admins()->get();

        return view('admin.dashboard', compact(
            'total_users',
            'total_products',
            'total_delivered_orders',
            'total_pending_orders',
            'admins'
        ));
    }
}
