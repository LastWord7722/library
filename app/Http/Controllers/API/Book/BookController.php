<?php

namespace App\Http\Controllers\API\Book;

use App\Http\Controllers\API\BaseController;
use App\Http\Requests\Book\BookRequestStore;
use App\Http\Requests\Book\BookRequestUpdate;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Service\Book\BookService;
use Illuminate\Http\Request;
use function response;


class BookController extends BaseController
{
    public function index()
    {
        return BookResource::collection(Book::with('authors')->paginate(15));
    }

    public function store(BookRequestStore $request, BookService $service)
    {
        $data = $request->validated();
        $dataCreate = $service->store($data);
        return $dataCreate;
    }

    public function uplodeFile(Book $book, Request $request,  BookService $service){
        $data = $request->validate([
            'image' => 'required|file|max:2024'
        ]);
        $newImage = $service->uplodeFile($data,$book);

        return  $newImage;
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
