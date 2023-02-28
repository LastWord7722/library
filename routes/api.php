<?php

use App\Http\Controllers\API\AuthorController;
use App\Http\Controllers\API\BookController;

use App\Http\Controllers\API\BookFilterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'author'], function (){

});

Route::group(['prefix' => 'book', 'namespace'=>'App\Http\Controllers\Api'], function (){
    //CRUD
    Route::get('/',[BookController::class, 'index']);
    Route::post('/store',[BookController::class, 'store']);
    Route::post('/uplodeFile/{book}',[BookController::class, 'uplodeFile']);
    Route::put('/update/{book}',[BookController::class, 'update']);
    Route::delete('/delete/{book}',[BookController::class, 'delete']);

    //FILTER
    Route::get('/getBook/AZ',[BookFilterController::class,'getBookAZ']);
    Route::get('/getBook/ZA',[BookFilterController::class,'getBookZA']);
    Route::get('/searchBook',[BookFilterController::class,'searchBook']);

});

Route::group(['prefix' => 'author', 'namespace'=>'App\Http\Controllers\Api'], function (){
    //CRUD
    Route::get('/',[AuthorController::class, 'index']);
    Route::delete('/delete/{author}',[AuthorController::class, 'delete']);
});

