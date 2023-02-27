<?php

namespace App\Service\Book;

use App\Models\Book;
use Illuminate\Support\Facades\DB;
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

}