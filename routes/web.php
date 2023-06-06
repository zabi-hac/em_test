<?php

use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])->group(function () {

    Route::get('/products', [ProductController::class, 'viewProducts'])->name('viewProducts');

    Route::get('/create-product', [ProductController::class, 'createProductview'])->name('createProductview');


    Route::post('/create-product', [ProductController::class, 'createProduct'])->name('create-product');

    Route::get('/edit-product', [ProductController::class, 'editProductview'])->name('editProductview');
    Route::post('/edit-product', [ProductController::class, 'editProduct'])->name('editProduct');


    Route::get('/delete-product', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
});


require __DIR__ . '/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// products
