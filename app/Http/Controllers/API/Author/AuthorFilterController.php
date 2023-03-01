<?php

namespace App\Http\Controllers\API\Author;

use App\Http\Controllers\API\BaseController;
use App\Http\Resources\AuthorResource;
use App\Models\Author;
use App\Service\Book\AuthorService;
use Illuminate\Http\Request;


class AuthorFilterController extends BaseController
{
    public function getAuthorAZ(){

        return AuthorResource::collection(Author::orderBy('last_name', 'asc')->paginate(15));
    }

    public function getAuthorZA(){

        return AuthorResource::collection(Author::orderBy('last_name', 'desc')->paginate(15));
    }

    public function searchAuthor(Request $request, AuthorService $service){

        $data = $service->searchAuthor($request);

        return $data;
    }
}
