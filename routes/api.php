<?php

use App\Http\Controllers\API\BookController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'author'], function (){

});

Route::group(['prefix' => 'book', 'namespace'=>'App\Http\Controllers\Api'], function (){
    Route::get('/',[BookController::class, 'index'])->name('api.book.index');
    Route::delete('/delete/{book}',[BookController::class, 'delete'])->name('api.book.delete');
});

