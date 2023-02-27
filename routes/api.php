<?php

use App\Http\Controllers\API\AuthorController;
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
    Route::post('/store',[BookController::class, 'store'])->name('api.book.create');
    Route::put('/update/{book}',[BookController::class, 'update'])->name('api.book.update');
    Route::delete('/delete/{book}',[BookController::class, 'delete'])->name('api.book.delete');
});

Route::group(['prefix' => 'author', 'namespace'=>'App\Http\Controllers\Api'], function (){
    Route::get('/',[AuthorController::class, 'index'])->name('api.author.index');
    Route::delete('/delete/{author}',[AuthorController::class, 'delete'])->name('api.author.delete');
});

