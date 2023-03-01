<?php

namespace App\Service\Book;

use App\Models\Author;
use App\Models\Book;

class AuthorService
{
    public function store($data)
    {

        $bookIds = $data['book_ids'];
        unset($data['book_ids']);

        $author = Author::create($data);

        $author->books()->attach($bookIds);

        return $author;
    }

    public function update($data, $author)
    {
        $author->books()->detach();
        $boolIds = $data['book_ids'];

        $author->books()->attach($boolIds);
        unset($data['book_ids']);

        $author->update([
            'last_name' => $data['last_name'],
            'middle_name' => $data['middle_name'],
            'first_name' => $data['first_name'],
        ]);
        return $author;

    }

    public function searchAuthor($request)
    {
        $authors = Author::with('books')->
        where('last_name', 'LIKE', '%'.$request->search.'%')->
            orwhere('first_name', 'LIKE', '%'.$request->search.'%')->
        get();

        return $authors;
    }

}