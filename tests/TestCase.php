<?php

use Illuminate\Support\Facades\Artisan;

class TestCase extends Laravel\Lumen\Testing\TestCase
{
    /**
     * Default preparation for each test
     */
    // public function setUp()
    // {
    //     parent::setUp();
    //
    //     $this->prepareForTests();
    // }

    /**
     * Migrates the database and set the mailer to 'pretend'.
     * This will cause the tests to run quickly.
     *
     */
    //  private function prepareForTests()
    //  {
    //     Artisan::call('migrate');
    //     // Mailer::pretend(true);
    //  }

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    /**
     * See if the response has a header
     *
     * @param $header
     * @return $this
     */
    public function seeHasHeader($header)
    {
        $this->assertTrue(
            $this->response->headers->has($header),
            "Response should have the header '{$header}', but does not."
        );

        return $this;
    }

    public function seeHeaderWithRegExp($header, $regexp)
    {
        $this->seeHasHeader($header)
             ->assertRegExp(
                              $regexp,
                              $this->response->headers->get($header)
        );

        return $this;
    }
}
