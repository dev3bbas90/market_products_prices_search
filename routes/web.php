<?php

use App\Http\Controllers\ProductsController;
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

Route::group(['prefix'      => 'Products'], function () {
    Route::get('/'          , [ProductsController::class,'index'])->name('products.index');
    Route::get('/data'      , [ProductsController::class,'data'])->name('products.data');
    Route::delete('/destroy/{id}', [ProductsController::class,'destroy'])->name('products.destroy');
    Route::get('/create'    , [ProductsController::class,'create'])->name('products.create');
    Route::post('/store'    , [ProductsController::class,'store'])->name('products.store');
    Route::get('/{id}'      , [ProductsController::class,'edit'])->name('products.edit');
    Route::post('/update'   , [ProductsController::class,'update'])->name('products.update');
});
