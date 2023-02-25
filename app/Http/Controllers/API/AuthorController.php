<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\BookResource;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index(){
        return AuthorResource::collection(Author::all());
    }

    public function delete(Author $author){
        $author->delete();
        return response([]);
    }
}
