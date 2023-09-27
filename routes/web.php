<?php

use App\Controllers\HomeController;
use App\Controllers\ProductController;
use MgahedMvc\Http\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/product', [ProductController::class, 'jsonIndex']);
Route::get('/product/get', [ProductController::class, 'jsonGet']);
Route::post('/product/save-api', [ProductController::class, 'jsonInsert']);

Route::get('/product/set', [ProductController::class, 'all']);
Route::get('/product/new', [ProductController::class, 'create']);
Route::delete('/products/delete', [ProductController::class, 'delete']);