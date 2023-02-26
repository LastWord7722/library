<?php

namespace App\Http\Controllers\API;


use App\Http\Requests\Book\BookRequestStore;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Service\Book\BookService;


class BookController extends BaseController
{
    public function index()
    {
        return BookResource::collection(Book::all());
    }

    public function store(BookRequestStore $requestStore, BookService $service)
    {
        $data = $requestStore->validated();
        $dataCreate = $service->store($data);
        return $dataCreate;

    }
    public function update()
    {


    }

    public function delete(Book $book)
    {
        $book->delete();
        return response([]);
    }
}
