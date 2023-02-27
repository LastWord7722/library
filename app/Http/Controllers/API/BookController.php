<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Book\BookRequestStore;
use App\Http\Requests\Book\BookRequestUpdate;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Service\Book\BookService;
use Illuminate\Http\Request;


class BookController extends BaseController
{
    public function index()
    {
        return BookResource::collection(Book::all());
    }

    public function store(BookRequestStore $request, BookService $service)
    {
        $data = $request->validated();
        $dataCreate = $service->store($data);
        return $dataCreate;

    }

    public function oneBook(BookRequestStore $request, BookService $service)
    {
        $data = $request->validated();
        $dataCreate = $service->store($data);
        return $dataCreate;

    }
    public function update(BookRequestUpdate $request, Book $book)
    {

        $data = $request->validate([
            'title'=> 'string',
            'info'=> 'string'
        ]);

        $book->updated($data);

        return $data;
    }

    public function delete(Book $book)
    {
        $book->delete();
        return response([]);
    }
}
