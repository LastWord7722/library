<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'authors';

    protected $fillable = [
        'name',
        'middle_name',
        'last_name',

    ];

    public function books(){
        return $this->belongsToMany(Book::class, 'authors_books','author_id' ,  'book_id');
    }
}
