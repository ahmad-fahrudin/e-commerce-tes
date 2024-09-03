<?php

use App\Http\Controllers\Frontend\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\ProductsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/',  [ProductsController::class, 'shop'])->name('products.shop');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    //admins
    Route::controller(AdminController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
    });
    //products
    Route::controller(ProductController::class)->group(function () {
        Route::get('/all-products', 'displayProducts')->name('products.all');
        Route::get('/create-products', 'createProducts')->name('products.create');
        Route::post('/create-products', 'storeProducts')->name('products.store');
        Route::get('/edit-products/{id}', 'editProducts')->name('products.edit');
        Route::post('/update-products', 'updateProducts')->name('products.update');
        Route::get('/delete-products/{id}', 'deleteProducts')->name('products.delete');
    });

    // //orders
    Route::controller(OrderController::class)->group(function () {
        Route::get('/all-orders', 'allOrders')->name('orders.all');
        // Route::get('/edit-orders/{id}', 'editOrders')->name('orders.edit');
        // Route::post('/update-orders/{id}', 'updateOrders')->name('orders.update');
        Route::get('/delete-orders/{id}', 'deleteOrders')->name('orders.delete');
    });
});

Route::group(['prefix' => 'products'], function () {
    //products
    Route::controller(ProductsController::class)->group(function () {
        Route::get('/category/{id}',  'singleCategory')->name('single.category');
        Route::get('/single-product/{id}',  'singleProduct')->name('single.product');

        //cart
        Route::post('/add-cart',  'addToCart')->name('products.add.cart');
        Route::get('/cart',  'cart')->name('products.cart')->middleware('auth:web');
        Route::get('/delete-cart/{id}',  'deleteFromCart')->name('products.cart.delete');

        //checkout and paying
        Route::post('/prepare-checkout',  'prepareCheckout')->name('products.prepare.checkout');
        Route::get('/checkout',  'checkout')->name('products.checkout')->middleware('check.for.price');
        Route::post('/checkout',  'proccessCheckout')->name('products.proccess.checkout')->middleware('check.for.price');
        Route::get('/pay/{id}',  'payWithPaypal')->name('products.pay')->middleware('check.for.price');
        Route::get('/success',  'success')->name('products.success')->middleware('check.for.price');
    });
});

Route::group(['prefix' => 'users'], function () {
    //users pages
    Route::get('/my-orders', [UsersController::class, 'myOrders'])->name('users.orders')->middleware('auth:web');
    Route::get('/settings', [UsersController::class, 'settings'])->name('users.settings')->middleware('auth:web');
    Route::post('/settings/{id}', [UsersController::class, 'updateUserSettings'])->name('users.settings.update')->middleware('auth:web');
});

Route::controller(AdminController::class)->group(
    function () {
        Route::get('admin/login', 'viewLogin')->name('view.login')->middleware('check.for.auth');
        Route::post('admin/login', 'checkLogin')->name('check.login');
        Route::post('admin/logout', 'adminLogout')->name('admin.logout');
    }
);
