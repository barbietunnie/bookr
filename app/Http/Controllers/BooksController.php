<?php

namespace App\Http\Controllers;

use App\Book;

/**
 * Class BooksController
 * @package App\Http\Controllers
 */
class BooksController
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
    return Book::all();
  }

  /**
   * GET /books/{id}
   * @param integer $id
   * @return mixed
   */
  public function show($id)
  {
    return Book::findOrFail($id);
  }
}
