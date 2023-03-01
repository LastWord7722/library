<?php

namespace App\Http\Controllers\API\Author;

use App\Http\Controllers\Controller;
use App\Http\Requests\Author\AuthorRequestStore;
use App\Http\Requests\Author\AuthorRequestUpdate;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Service\Book\AuthorService;
use function response;

class AuthorController extends Controller
{
    public function index(){
        return AuthorResource::collection(Author::paginate(15));
    }

    public function store(AuthorRequestStore $request, AuthorService $service)
    {
        $data = $request->validated();

        $newAuthor = $service->store($data);

        return $newAuthor;
    }

    public function update(AuthorRequestUpdate $request, Author $author,AuthorService $service)
    {
        $data = $request->validated();;

        $newAuthor = $service->update($data, $author);

        return $newAuthor;
    }

    public function delete(Author $author)
    {
        $author->delete();
        return response([]);
    }
}
