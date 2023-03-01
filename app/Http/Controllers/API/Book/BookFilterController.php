<?php

namespace App\Http\Controllers\API\Book;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Service\Book\BookService;
use Illuminate\Http\Request;


class BookFilterController extends BaseController
{
    public function getBookAZ(){

        return BookResource::collection(Book::orderBy('title', 'asc')->paginate(15));
    }

    public function getBookZA(){

        return BookResource::collection(Book::orderBy('title', 'desc')->paginate(15));
    }

    public function searchBook(Request $request, BookService $service){

        $data = $service->searchBook($request);

        return $data;
    }
}
