<?php

namespace App\Http\Controllers\Public;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\Public\OrderRequest;

class PublicOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = User::authUser()->orders()->latest()->paginate(10);

        return view('public.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $cart = User::authUser()->cart()->first();

        abort_if(!$cart, 404, 'Cart not found');

        return view('public.orders.create', compact('cart'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(OrderRequest $request): RedirectResponse 
    {
        $user = User::authUser();
        $cart = $user->cart()->first();

        if($request->total_amount != $cart->total_price)
        {
            alert()->error('Total amount is not equal to cart total price');

            return redirect()->back();
        }

        $request->amount             = $cart->total_price;
        $request['user_name']        = $user->name;
        $request['billing_address']  = auth()->user()->address;
        $request['shipping_address'] = auth()->user()->address;
        $request['total_amount']     = $cart->total_price;

        $request['payment_amount'] = $cart->total_price;
        $request['payment_status'] = 'paid';

        try {
            DB::transaction(function () use ($request, $cart, $user)
            {
                $order = $user->orders()->create($request->all());

                $order->orderDetails()->createMany($this->makeOrderDetails($cart));

                $user->payments()->create($request->all());

                $cart->delete();
            });

            alert()->success('Order confirmed.');
    
            return redirect()->route('orders.index');
        }
        catch (\Exception$e)
        {
            alert()->error('Something went wrong!');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order): View
    {
        return view('public.orders.show', compact('order'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    /**
     * @param Cart $cart
     * @return array
     */
    private function makeOrderDetails(Cart $cart): array
    {
        $orderDetails = [];

        foreach ($cart->products as $product)
        {
            $orderDetails[] = [
                'product_id' => $product->id,
                'quantity'   => $product->pivot->quantity,
                'price'      => $product->pivot->quantity * $product->offer_price,
            ];
        }

        return $orderDetails;
    }
}
