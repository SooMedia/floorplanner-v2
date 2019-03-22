<?php
declare(strict_types=1);

namespace Tests\Endpoints;

use GuzzleHttp\Psr7\Response;
use SooMedia\Floorplanner\Exceptions\FloorplannerClientException;
use SooMedia\Floorplanner\Exceptions\FloorplannerServerException;

/**
 * Class BaseEndpointTest
 *
 * @package Tests\Endpoints
 * @coversDefaultClass \SooMedia\Floorplanner\Endpoints\BaseEndpoint
 */
class BaseEndpointTest extends EndpointTestCase
{
    /**
     * @covers ::makeRequest
     * @covers ::getExceptionMessage
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerException
     */
    public function testServerException(): void
    {
        $this->expectException(FloorplannerServerException::class);
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage('Some error');

        $container = [];

        $client = $this->getClient([
            new Response(500, [], json_encode([
                'status' => 500,
                'error' => 'Some error',
            ])),
        ], $container);

        $client->projects()->show(170280);
    }

    /**
     * @covers ::makeRequest
     * @covers ::getExceptionMessage
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerException
     */
    public function testClientException(): void
    {
        $this->expectException(FloorplannerClientException::class);
        $this->expectExceptionCode(404);
        $this->expectExceptionMessage('Not Found');

        $container = [];

        $client = $this->getClient([
            new Response(404, [], json_encode([
                'status' => 404,
                'error' => 'Not Found',
            ])),
        ], $container);

        $client->projects()->show(170280);
    }

    /**
     * @covers ::makeRequest
     * @covers ::getExceptionMessage
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerException
     */
    public function testExceptionWithoutJson(): void
    {
        $this->expectException(FloorplannerServerException::class);
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage('Some error');

        $container = [];

        $client = $this->getClient([
            new Response(500, [], 'Some error'),
        ], $container);

        $client->projects()->show(170280);
    }
}
