<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Category;
use App\Notifications\ItemDeleted;
use Illuminate\Support\Facades\Notification;

class CategoryObserver
{
    /**
     * Handle the Category "deleted" event.
     *
     * @param  \App\Models\Category  $category
     * @return void
     */
    public function deleted(Category $category)
    {
        Notification::send(
            User::superAdmins()->except(auth()->user()->id), 
            new ItemDeleted($category, 'Category', route('admin.categories.trashed'))
        );
    }
}
