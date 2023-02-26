<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Book\BookRequestStore;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Service\Book\BookService;


class BaseController extends Controller
{
    public $service;

    public function __construct(BookService $service)
    {
        $this->service = $service;
    }
}
