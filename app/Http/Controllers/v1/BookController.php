<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
  public function list(Request $request)
  {
    $lstObj = Book::get();
    return $this->sendResponse($lstObj, 'Book list');
  }
}
