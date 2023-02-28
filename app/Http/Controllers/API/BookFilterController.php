<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;


class BookFilterController extends Controller
{
    public function getBookAZ()
    {
        $books = Book::orderBy('title','asc')->get();

        return $books;
    }

    public function getBookZA()
    {
        $books = Book::orderBy('title','desc')->get();

        return $books;
    }

    public function searchBook(Request $request){
        $books = Book::where('title', 'LIKE', '%'.$request->search.'%')->get();

        return $books;
        /*$aurhors = Author::with('books')->where('last_name', 'LIKE', '%'.$request->search.'%')->get();*/

        /* if($aurhors){
             foreach ($aurhors as $author)
                 $oneAuthor = $author->books;
                 return $oneAuthor;
         }*/
    }
}
