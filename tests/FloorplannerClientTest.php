<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use SooMedia\Floorplanner\Endpoints\BaseEndpoint;
use SooMedia\Floorplanner\FloorplannerClient;

/**
 * Class FloorplannerClientTest
 *
 * @package Tests
 * @coversDefaultClass \SooMedia\Floorplanner\FloorplannerClient
 */
class FloorplannerClientTest extends TestCase
{
    /**
     * @covers ::__construct
     * @covers ::getHttpClient
     */
    public function testGetHttpClient(): void
    {
        $apiKey = 'mock_api_key';

        $httpClientOptions = [
            'timeout' => 2.0,
        ];

        $client = new FloorplannerClient($apiKey, $httpClientOptions);

        $httpClient = $client->getHttpClient();

        $this->assertAttributeEquals('mock_api_key', 'apiKey', $client);
        $this->assertAttributeEquals([
            'timeout' => 2.0,
        ], 'httpClientOptions', $client);
        $this->assertAttributeEquals($httpClient, 'httpClient', $client);
    }

    /**
     * @covers ::__construct
     * @covers ::getHttpClient
     * @covers ::projects
     * @covers \SooMedia\Floorplanner\Endpoints\BaseEndpoint::__construct
     */
    public function testProjects(): void
    {
        $client = new FloorplannerClient('mock_api_key');

        $projects = $client->projects();

        $this->assertInstanceOf(BaseEndpoint::class, $projects);
    }
}
