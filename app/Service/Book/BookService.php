<?php

namespace App\Service\Book;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;


class BookService
{
    public function store($data)
    {
        $authorIds = $data['author_ids'];
        unset($data['author_ids']);

       $data['image'] = Storage::disk('public')->put('images/book', $data ['image']);

        $book = Book::firstOrcreate($data);
        $book->authors()->attach($authorIds);

        return $book;
    }

    public function update($data, $book)
    {
        $book->authors()->detach();
        $authorIds = $data['author_ids'];

        $book->authors()->attach($authorIds);
        unset($data['author_ids']);

        $book->update([
            'title' => $data['title'],
            'info' => $data['info'],
        ]);

        return $book;

    }


    public function uplodeFile($data, $book)
    {
        $oldImage = $book->image;
        Storage::disk('public')->delete($oldImage);
        $data['image'] = Storage::disk('public')->put('images/book', $data ['image']);

        $book->update([
            'image' => $data['image']
        ]);

        return $book;
    }

    public function searchBook($request)
    {
        $books = Book::with('authors')->
        where('title', 'LIKE', '%'.$request->search.'%')->
        get();

        $authors = Author::with('books')->
        where('last_name', 'LIKE', '%'.$request->search.'%')->
        get();

        if($authors){
            foreach ($authors as $author){
                $authorBook = $author->books;
                $res = $books->merge($authorBook);
                return $res;
            }
        }else{
            return $books;
        }

    }

}