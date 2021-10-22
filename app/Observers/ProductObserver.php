<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Product;
use App\Notifications\ItemDeleted;
use Illuminate\Support\Facades\Notification;

class ProductObserver
{
    /**
     * Handle the Product "deleted" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function deleted(Product $product)
    {
        Notification::send(
            User::superAdmins()->except(auth()->user()->id),
            new ItemDeleted($product, 'Product', route('admin.products.trashed'))
        );
    }
}
