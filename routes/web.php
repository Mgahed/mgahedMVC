<?php

use App\Controllers\HomeController;
use MgahedMvc\Http\Route;

Route::get('/', [HomeController::class, 'index']);