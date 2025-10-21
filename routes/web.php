<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/products', [ProductController::class, "index"]);
Route::get('/products/create', [ProductController::class, "create"]);
//for submit form
Route::post('newproducts', [ProductController::class, 'store']);
Route::get('/products/{id}', [ProductController::class, "show"])->where("id", "[0-9]+");
