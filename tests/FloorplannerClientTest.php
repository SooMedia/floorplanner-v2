<?php
declare(strict_types=1);

namespace Tests;

use GuzzleHttp\ClientInterface;
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

        $client = new FloorplannerClient(
            $apiKey,
            FloorplannerClient::BASE_URI,
            FloorplannerClient::API_ENDPOINT,
            $httpClientOptions
        );

        $this->assertEquals($apiKey, $client->getApiKey());
        $this->assertEquals($httpClientOptions, $client->getHttpClientOptions());
        $this->assertInstanceOf(ClientInterface::class, $client->getHttpClient());
    }

    /**
     * @covers ::__construct
     * @covers ::getHttpClient
     * @covers ::users
     * @covers \SooMedia\Floorplanner\Endpoints\BaseEndpoint::__construct
     */
    public function testUsers(): void
    {
        $client = new FloorplannerClient('mock_api_key');

        $users = $client->users();

        $this->assertInstanceOf(BaseEndpoint::class, $users);
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

    /**
     * @covers ::__construct
     * @covers ::getHttpClient
     * @covers ::projectPermissions
     * @covers \SooMedia\Floorplanner\Endpoints\BaseEndpoint::__construct
     */
    public function testProjectPermissions(): void
    {
        $client = new FloorplannerClient('mock_api_key');

        $projectPermissions = $client->projectPermissions();

        $this->assertInstanceOf(BaseEndpoint::class, $projectPermissions);
    }
}
