<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $cart = Cart::userProduct()->first();

        return view('public.cart', compact('cart'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Cart::class);

        try {
            DB::transaction(function () use ($request)
            {
                $cart = Cart::userProduct()->first();

                if (!$cart)
                {
                    $user = User::where('id', auth()->user()->id)->first();
                    $cart = $user->cart()->create(['total_price' => 0]);
                    $cart->products()->attach($request->product_id, ['quantity' => 1]);
                }

                $product = $cart->products->where('id', $request->product_id)->first();

                $product
                    ? $product->pivot->increment('quantity')
                    : $cart->products()->attach($request->product_id, ['quantity' => 1]);

                $cart->update(['total_price' => $this->countTotal($cart)]);
            });

            alert()->success('Product added to cart', 'Success');

            return redirect()->back()->with('success', 'Product added to cart');
        }
        catch (\Exception$e)
        {
            alert()->error($e->getMessage(), 'Error');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCartRequest $request, Cart $cart): RedirectResponse
    {
        $this->authorize('update', $cart);

        try {
            DB::transaction(function () use ($request)
            {
                $user = User::where('id', auth()->user()->id)->first();
                $cart = $user->cart()->first();

                $cart->products()->detach();

                foreach ($request->product_id as $key => $product_id)
                {
                    if ($request->quantity[$key])
                    {
                        $cart->products()->attach($product_id, ['quantity' => $request->quantity[$key]]);
                    }
                }

                $cart->update(['total_price' => $this->countTotal($cart)]);
            });

            alert()->success('Cart updated', 'Success');

            return redirect()->back()->with('success', 'Product added to cart');
        }
        catch (\Exception$e)
        {
            alert()->error($e->getMessage(), 'Error');

            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart): RedirectResponse
    {
        $this->authorize('delete', $cart);

        try {
            $cart->delete();

            alert()->success('Cart updated', 'Success');

            return redirect()->back();
        }
        catch (\Exception$e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Counts total price of cart.
     * 
     * @param Cart $cart
     */
    private function countTotal(Cart $cart): int
    {
        $total = 0;

        foreach ($cart->products as $product)
        {
            $total += round($product->pivot->quantity * $product->offer_price);
        }

        return intval($total);
    }
}
