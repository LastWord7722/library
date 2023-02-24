<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'books';

    protected $fillable = [
        'title',
        'info',
        'image'
    ];

    public function authors(){
        return $this->belongsToMany(Author::class, 'authors_books', 'book_id', 'author_id');
    }
}
