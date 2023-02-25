<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        return BookResource::collection(Book::all());
    }

    public function delete(Book $book){
        $book->delete();
        return response([]);
    }
}
