<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookIndex;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

    $lstObj = $queryBuilder->with('indices')->with('user')->distinct()->paginate($perPage);
    return $this->sendResponse($lstObj, 'Book list');
  }
  public function create(Request $request)
  {
    // this will check for 3 levels only, further validation will be done aftewards
    $validator = Validator::make($request->all(), [
      'title' => 'required',
      'page' => 'required|integer',
      'indices' => 'array',
      'indices.*.title' => 'required',
      'indices.*.page' => 'required|integer',
      'indices.*.sub_indices.*.title' => 'required',
      'indices.*.sub_indices.*.page' => 'required|integer',
      'indices.*.sub_indices.*.sub_indices.*.title' => 'required',
      'indices.*.sub_indices.*.sub_indices.*.page' => 'required|integer',
    ]);
    if ($validator->fails()) {
      return $this->sendError('Validation Error.', $validator->errors());
    }
    try {
      DB::beginTransaction();
      $obj = Book::create([
        'title' => $request->title,
        'user_id' => Auth::user()->id
      ]);
      if (isset($request->indices)) {
        $this->processIndices($obj->id, $request->indices);
      }
      DB::commit();
      return $this->sendResponse($obj, 'Book created by '. Auth::user()->id);
    } catch (\Throwable $th) {
      DB::rollBack();
      return $this->sendError($th->getMessage());
    }
  }
  public function update(Request $request, $book_id)
  {
    $obj = Book::find($book_id);
    $obj->title = $request->title;
    $obj->save();
    return $this->sendResponse($obj, 'Book updated');
  }
  private function processIndices($book_id, $items, $index_id = null) {
    foreach ($items as $item) {
      if (!isset($item['title']) || !isset($item['page'])) {
        throw new Error('Title and/or page not found');
      }
      $index = BookIndex::create([
        'book_id' => $book_id,
        'title' => $item['title'],
        'page' => $item['page'],
        'index_id' => $index_id,
      ]);
      if (isset($item['sub_indices'])) {
        $this->processIndices($book_id, $item['sub_indices'], $index->id);
      }
    }
  }
}
