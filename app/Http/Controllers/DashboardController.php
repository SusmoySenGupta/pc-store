<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
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
        $users_except_super_admins = User::exceptSuperAdmin();
        $users = $users_except_super_admins->limit(10)->get();
        $total_users = $users_except_super_admins->count();

        $orders                 = Order::all();
        $total_delivered_orders = $orders->where('is_delivered', 1)->count();
        $total_pending_orders   = $orders->count() - $total_delivered_orders;

        $total_products = Product::count();

        $total_incomes = Payment::all()->sum('amount');

        return view('admin.dashboard', compact(
            'users',
            'total_users',
            'total_products',
            'total_delivered_orders',
            'total_pending_orders',
            'total_incomes'
        ));
    }
}
