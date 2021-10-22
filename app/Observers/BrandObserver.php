<?php

namespace App\Observers;

use App\Models\Brand;
use App\Models\User;
use App\Notifications\ItemDeleted;
use Illuminate\Support\Facades\Notification;

class BrandObserver
{
    /**
     * Handle the Brand "deleted" event.
     *
     * @param  \App\Models\Brand  $brand
     * @return void
     */
    public function deleted(Brand $brand)
    {
        Notification::send(
            User::superAdmins()->except(auth()->user()->id),
            new ItemDeleted($brand, 'brand', route('admin.brands.trashed'))
        );
    }
}
