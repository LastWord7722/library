<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Author;

use App\Models\Book;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Book::factory(50)->create();
        Author::factory(50)->create();

        $authors = Author::all();

        Author::all()->each(function ($book) use ($authors) {
            $book->books()->attach(
                $authors->random(rand(1, 2))->pluck('id')->toArray()
            );
        });
    }
}
