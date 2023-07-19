<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\LogoutController;


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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    /**
    * Logout Route
    */
    Route::get('/logout', [App\Http\Controllers\Auth\LogoutController::class, 'perform'])->name('perform');
});



// Route::prefix('/home')->group(function() {
//     Route::get('/', [HomeController::class, 'index'])->name('home');
//     // Route::get('/cart/view', [CartController::class, 'viewCart']);
//     // Route::get('/cart/add/{id}', [CartController::class, 'addToCart']);
// });

Route::prefix('/cart')->group(function() {
    Route::get('/view', [CartController::class, 'viewCart']);
    Route::get('/add/{id}', [CartController::class, 'addToCart']);
    Route::get('/delete/{id}', [CartController::class, 'deleteCart']);
    Route::get('/update/{id}/{qty}', [CartController::class, 'updateCart']);
    Route::get('/checkout', [CartController::class, 'checkout']);
    Route::get('/complete', [CartController::class, 'complete']);
    Route::get('/finish', [CartController::class, 'finish_order']);
});

Route::prefix('/product')->group(function() {
    Route::get('/',[ProductController::class, 'index']);

    Route::get('/search',[ProductController::class, 'onSearch']);
    Route::post('/search',[ProductController::class, 'onSearch']);
    
    Route::get('/edit/{id?}',[ProductController::class, 'getFormEdit']);
    Route::post('/update/', [ProductController::class, 'onUpdate']);
    
    Route::get('/add', [ProductController::class, 'getFormAdd']);
    Route::post('/insert/', [ProductController::class, 'onInsert']);
    
    Route::get('/remove/{id}', [ProductController::class, 'onRemove']);
});

Route::prefix('/category')->group(function() {
    Route::get('/',[CategoryController::class, 'index']);

    Route::get('/search',[CategoryController::class, 'onSearch']);
    Route::post('/search',[CategoryController::class, 'onSearch']);
    
    Route::get('/edit/{id?}',[CategoryController::class, 'getFormEdit']);
    Route::post('/update/', [CategoryController::class, 'onUpdate']);
    
    Route::get('/add', [CategoryController::class, 'getFormAdd']);
    Route::post('/insert/', [CategoryController::class, 'onInsert']);
    
    Route::get('/remove/{id}', [CategoryController::class, 'onRemove']);
});



