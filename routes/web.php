<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Public\CartController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Public\PublicOrderController;
use App\Http\Controllers\Public\PublicDashboardController;
use App\Http\Controllers\Public\ProductController as PublicProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products/category/{category}', [PublicProductController::class, 'index'])
    ->name('category_product');

Route::get('/products/{product:slug}', [PublicProductController::class, 'show'])
    ->name('product.show');

Route::middleware(['auth', 'verified'])->group(function ()
{
    Route::resource('cart', CartController::class);
    Route::resource('orders', PublicOrderController::class);

    Route::middleware(['is_super_admin_or_admin'])->prefix('admin')->name('admin.')->group(function ()
    {
        Route::get('/dashboard', DashboardController::class)->name('dashboard');
        Route::resource('user', UserController::class);

        //Categories routes
        Route::prefix('categories')->as('categories.')->group(function ()
        {
            Route::get('/trashed', [CategoryController::class, 'trashed'])
                ->name('trashed');

            Route::post('/restore/{category_id}', [CategoryController::class, 'restore'])
                ->name('restore');

            Route::delete('/force-delete/{category_id}', [CategoryController::class, 'forceDelete'])
                ->name('force_delete');

            Route::resource('/', CategoryController::class)
                ->parameter('', 'category');
        });

        //Brand routes
        Route::prefix('brands')->as('brands.')->group(function ()
        {
            Route::get('/trashed', [BrandController::class, 'trashed'])
                ->name('trashed');

            Route::post('/restore/{brand_id}', [BrandController::class, 'restore'])
                ->name('restore');

            Route::delete('/force-delete/{brand_id}', [BrandController::class, 'forceDelete'])
                ->name('force_delete');

            Route::resource('/', BrandController::class)
                ->parameter('', 'brand');
        });

        //Product routes
        Route::prefix('products')->as('products.')->group(function ()
        {
            Route::get('/trashed', [ProductController::class, 'trashed'])
                ->name('trashed');

            Route::post('/restore/{product_id}', [ProductController::class, 'restore'])
                ->name('restore');

            Route::delete('/force-delete/{product_id}', [ProductController::class, 'forceDelete'])
                ->name('force_delete');

            Route::resource('/', ProductController::class)
                ->parameter('', 'product');
        });

        Route::resource('tags', TagController::class)->except('show');
        Route::resource('orders', OrderController::class)->only('index', 'show', 'update');
        // Route::resource('components', ComponentController::class)->except('show');

        //Notification routes
        Route::prefix('notifications')->as('notifications.')->group(function ()
        {
            Route::get('/alerts', [NotificationController::class, 'alert'])
                ->name('alerts');
            Route::delete('/alerts/clear', [NotificationController::class, 'clearAlert'])
                ->name('alerts.clear');
        });
    });
});
