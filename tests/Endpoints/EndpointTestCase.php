<?php
declare(strict_types=1);

namespace Tests\Endpoints;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;
use SooMedia\Floorplanner\FloorplannerClient;

/**
 * Class EndpointTestCase
 *
 * @package Tests\Endpoints
 */
abstract class EndpointTestCase extends TestCase
{
    /**
     * Get the FloorplannerClient for testing.
     *
     * @param array              $queue
     * @param array|\ArrayAccess $container
     * @return FloorplannerClient
     */
    protected function getClient(
        array $queue,
        &$container
    ): FloorplannerClient {
        $mockHandler = new MockHandler($queue);

        $history = Middleware::history($container);

        $handlerStack = HandlerStack::create($mockHandler);

        $handlerStack->push($history);

        return new FloorplannerClient(
            'mock_api_key',
            FloorplannerClient::BASE_URI,
            FloorplannerClient::API_ENDPOINT,
            [
                'handler' => $handlerStack,
            ]
        );
    }

    /**
     * Validate an HTTP request made by the client.
     *
     * @param Request     $request
     * @param string      $method
     * @param string      $uri
     * @param array       $headers
     * @param string|null $requestBody
     */
    protected function validateRequest(
        Request $request,
        string $method,
        string $uri,
        array $headers,
        string $requestBody = null
    ): void {
        $this->assertEquals($method, $request->getMethod());

        $this->assertEquals($uri, (string) $request->getUri());

        foreach ($headers as $header => $value) {
            $this->assertEquals(
                $value,
                $request->getHeaderLine($header)
            );
        }

        if ($requestBody) {
            $this->assertEquals($requestBody, (string) $request->getBody());
        }
    }
}
