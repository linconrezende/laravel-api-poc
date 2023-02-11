<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookIndex;
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

    $lstObj = $queryBuilder->with('indices')->distinct()->paginate($perPage);
    return $this->sendResponse($lstObj, 'Book list');
  }
  public function create(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'title' => 'required',
      'page' => 'required|integer',
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
        $indices = $request->indices;
        foreach ($indices as $k0 => $indx) {
          $index = BookIndex::create([
            'book_id' => $obj->id,
            'title' => $indx['title'],
            'page' => $indx['page']
          ]);

          if (isset($indx['sub_indices'])) {
            $subIndices1 = $indx['sub_indices'];
            foreach ($subIndices1 as $k1 => $sindx1) {
              $sindex1 = BookIndex::create([
                'book_id' => $obj->id,
                'title' => $sindx1['title'],
                'page' => $sindx1['page'],
                'index_id' => $index->id
              ]);
            }
            if (isset($sindx1['sub_indices'])) {
              $subIndices2 = $sindx1['sub_indices'];
              foreach ($subIndices2 as $k1 => $sindx2) {
                $sindex2 = BookIndex::create([
                  'book_id' => $obj->id,
                  'title' => $sindx2['title'],
                  'page' => $sindx2['page'],
                  'index_id' => $sindex1->id
                ]);
              }
              if (isset($sindx2['sub_indices'])) {
                $subIndices2 = $sindx2['sub_indices'];
                foreach ($subIndices2 as $k1 => $sindx3) {
                  $sindex3 = BookIndex::create([
                    'book_id' => $obj->id,
                    'title' => $sindx3['title'],
                    'page' => $sindx3['page'],
                    'index_id' => $sindex2->id
                  ]);
                }
              }
            }
          }
        }
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
}
