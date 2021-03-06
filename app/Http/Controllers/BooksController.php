<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Transformer\BookTransformer;

/**
 * Class BooksController
 * @package App\Http\Controllers
 */
class BooksController extends Controller
{
  /**
   * GET /books
   * @return array
   */
  public function index()
  {
    // return [
    //     ['title' => 'War of the Worlds'],
    //     ['title' => 'A Wrinkle in Time']
    // ];

    //return ['data' => Book::all()->toArray()];

    return $this->collection(Book::all(), new BookTransformer());
  }

  /**
   * GET /books/{id}
   * @param integer $id
   * @return mixed
   */
  public function show($id)
  {
    // try {
    //   return Book::findOrFail($id);
    // } catch(ModelNotFoundException $e) {
    //   return response()->json([
    //       'error' => [
    //             'message' => 'Book not found'
    //         ]
    //     ], 404);
    // }

    // Since the Handler class already handles exceptions,
    // remove the try/catch block

    // return ['data' => Book::findOrFail($id)->toArray()];

    return $this->item(Book::findOrFail($id), new BookTransformer());
  }

  /**
   * POST /books
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function store(Request $request)
  {
      $book = Book::create($request->all());
      $data = $this->item($book, new BookTransformer());

      return response()->json($data, 201,
                    ['Location'    =>  route('books.show', ['id' => $book->id])]);
  }

  /**
   * PUT /books/{id}
   *
   * @param Request $request
   * @param $id
   * @return mixed
   */
  public function update(Request $request, $id)
  {
      try {
          $book = Book::findOrFail($id);
      } catch(ModelNotFoundException $e) {
          return response()->json([
              'error' => [
                    'message' => 'Book not found'
                ]
          ], 404);
      }


      $book->fill($request->all());
      $book->save();

      // return ['data' => $book->toArray()];
      return $this->item($book, new BookTransformer());
  }

  /**
   * DELETE /books/{id}
   * @param $id
   * @return \Illuminate\Http\JsonResponse
   */
  public function destroy($id)
  {
      try {
          $book = Book::findOrFail($id);
      } catch(ModelNotFoundException $e) {
          return response()->json([
              'error' => [
                    'message' => 'Book not found'
                ]
          ], 404);
      }

      $book->delete();

      return response(null, 204);
  }
}
