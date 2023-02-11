<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
  public function list(Request $request)
  {
    $perPage = 10;
    if (isset($request->perPage)) {
      $perPage = $request->perPage;
    }

    $queryBuilder = Book::where('1', '=', '1');
    
    if (isset($request->title)) {
      $queryBuilder->whereRaw("books.title LIKE '%$request->title%'");
    }

    if (isset($request->index_title)) {
      $queryBuilder->join('book_indices', 'book_indices.book_id', 'books.id')
      ->whereRaw("book_indices.title LIKE '%$request->index_title%'");
    }

    $lstObj = $queryBuilder->with('indices')->distinct()->paginate($perPage);
    return $this->sendResponse($lstObj, 'Book list');
  }
  public function create(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'title' => 'required',
    ]);
    if ($validator->fails()) {
      return $this->sendError('Validation Error.', $validator->errors());
    }
    $obj = Book::create([
      'title' => $request->title,
      'user_id' => Auth::user()->id
    ]);
    return $this->sendResponse($obj, 'Book created by '. Auth::user()->id);
  }
  public function update(Request $request, $book_id)
  {
    $obj = Book::find($book_id);
    $obj->title = $request->title;
    $obj->save();
    return $this->sendResponse($obj, 'Book updated');
  }
}
