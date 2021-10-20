<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\DashboardController;

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

Route::get('/dashboard', function ()
{
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function ()
{
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::resources([
        'categories' => CategoryController::class,
        'brands'     => BrandController::class,
        'products'   => ProductController::class,
    ]);

    // Route::resource('components', ComponentController::class)->except('show');
    Route::resource('tags', TagController::class)->except('show');
    Route::resource('orders', OrderController::class)->only('index', 'show', 'update');
    Route::resource('user', UserController::class)->only('show', 'edit', 'update');
});
