<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Book\BookRequestStore;
use App\Http\Requests\Book\BookRequestUpdate;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Service\Book\BookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
    public function uplodeFile(Book $book, Request $request,  BookService $service){
        $data = $request->validate([
            'image' => ''
        ]);

        $newImage = $service->uplodeFile($data,$book);
        return $newImage;
    }

    public function update(BookRequestUpdate $request, Book $book, BookService $service)
    {
        $data = $request->validated();
        $updateBook = $service->update($data,$book);

        return $updateBook;
    }

    public function delete(Book $book)
    {
        $book->delete();
        return response([]);
    }
}
