<?php

namespace Test\App\Http\Controllers;

use TestCase;

// use Laravel\Lumen\Testing\DatabaseTransactions;

class BooksControllerTest extends TestCase
{
    /** @test **/
    public function index_status_code_should_be_200()
    {
        $this->get('/books')->seeStatusCode(200);
    }

    /** @test **/
    public function index_should_return_a_collection_of_records()
    {
        $this->get('/books')
             ->seeJson([
                    'title' => 'War of the Worlds'
               ])
             ->seeJson([
                    'title' => 'A Wrinkle in Time'
               ]);
    }

    /** @test **/
    public function show_should_return_a_valid_book()
    {
        $this->markTestIncomplete('Pending Test');
    }

    /** @test **/
    public function show_should_fail_if_book_id_does_not_exist()
    {
        $this->markTestIncomplete('Pending Test');
    }

    public function show_route_show_not_match_an_invalid_route()
    {
        $this->markTestIncomplete('Pending Test');
    }
}
