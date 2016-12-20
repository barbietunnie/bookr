<?php

namespace Tests\App\Exceptions;

use TestCase;
use \Mockery as m;
use App\Exceptions\Handler;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * Unit tests for Exception Handler
 *
 * The tests to be performed are:
 *
 * - It responds with HTML when json is not requested
 * - It responds with json when json is requested
 * - It provides a default status code for non-HTTP Exceptions
 * - It provides a common HTTP status code for HTTP Exceptions
 * - It provides debug information when debugging is enabled
 * - It skips debugging information when debugging is disabled
 */
class HandlerTest extends TestCase
{
  /** @test **/
  public function it_responds_with_html_when_json_is_not_accepted()
  {

      // Make the mock a partial, you only want to mock the `isDebugMode` method
      $subject = m::mock(Handler::class)->makePartial();
      $subject->shouldNotReceive('isDebugMode');

      // Mock the interaction with th Request
      $request = m::mock(Request::class);
      $request->shouldReceive('wantsJson')->andReturn(false);

      // Mock the interaction with the exception
      $exception = m::mock(\Exception::class, ['Error!']);
      $exception->shouldNotReceive('getStatusCode');
      $exception->shouldNotReceive('getTrace');
      $exception->shouldNotReceive('getMessage');

      // Call the method under test, this is not a mocked method
      $result = $subject->render($request, $exception);

      // Asert that `render` does not return a JsonResponse
      $this->assertNotInstanceOf(JsonResponse::class, $result);
  }
}
