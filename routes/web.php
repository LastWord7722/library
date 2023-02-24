<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;


Route::get('/{page}',[MainController::class, '__invoke'])->where('page','.*');
