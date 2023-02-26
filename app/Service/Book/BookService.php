<?php

namespace App\Service\Book;

use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class BookService
{
    public function     store($data)
    {
        $authorIds = $data['author_ids'];
        unset($data['author_ids']);


       $data['image'] = Storage::disk('public')->put('images/book', $data ['image']);

        $book = Book::firstOrcreate($data);
        $book->authors()->attach($authorIds);

        return $book;

    }

    public function update($data){
        $authorIds = $data['author_ids'];
        unset($data['author_ids']);  //

        $inputImage = $data['image'];
        if($inputImage) {
            $data['image'] = Storage::disk('public')->put('images/image', $data ['image']);
        }

        $book = Book::firstOrcreate($data);
        $book->authors()->attach($authorIds);

        return $book;
    }
}