<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Service\Book\BookService;
use Illuminate\Http\Request;


class BookFilterController extends BaseController
{
    public function getBookAZ(){

        return BookResource::collection(Book::orderBy('title', 'asc')->get());
    }

    public function getBookZA(){

        return BookResource::collection(Book::orderBy('title', 'desc')->get());
    }

    public function searchBook(Request $request, BookService $service){

        $data = $service->searchBook($request);

        return $data;

    }
}
