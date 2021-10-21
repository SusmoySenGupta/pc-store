<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function ()
{
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function ()
{
    Route::middleware(['is_admin'])->prefix('admin')->name('admin.')->group(function ()
    {
        Route::get('/dashboard', DashboardController::class)->name('dashboard');
        Route::resource('user', UserController::class)->only('index', 'edit', 'update');

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

        Route::resource('brands', BrandController::class);
        Route::resource('products', ProductController::class);
        Route::resource('tags', TagController::class)->except('show');
        Route::resource('orders', OrderController::class)->only('index', 'show', 'update');
        // Route::resource('components', ComponentController::class)->except('show');
    });
});
