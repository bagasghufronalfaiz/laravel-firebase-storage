<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\ProductController;
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

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

/* Asset */
Route::get('/asset', [AssetController::class, 'index'])->name('asset.index');
Route::view('/asset/add', '/asset/add')->name('asset.add');
Route::post('/asset/store', [AssetController::class, 'store'])->name('asset.store');
Route::delete('/asset/{id}', [AssetController::class, 'destroy'])->name('asset.delete');

/* Category */
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::view('/category/add', '/category/add')->name('category.add');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.delete');


/* Product */
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/product/add', [ProductController::class, 'create'])->name('product.add');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
