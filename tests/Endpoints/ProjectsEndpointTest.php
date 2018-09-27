<?php

namespace Tests\Endpoints;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use SooMedia\Floorplanner\FloorplannerClient;

/**
 * Class ProjectsEndpointTest
 *
 * @package Tests\Endpoints
 * @coversDefaultClass \SooMedia\Floorplanner\Endpoints\ProjectsEndpoint
 */
class ProjectsEndpointTest extends TestCase
{
    /**
     * @var FloorplannerClient
     */
    protected $client;

    /**
     * This method is called before each test.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->client = new FloorplannerClient('mock_api_key');
    }

    /**
     * @covers ::create
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testCreate(): void
    {
        $response = [
            'id' => 170280,
            'user_id' => 103,
            'public' => false,
            'name' => 'My new house',
            'description' => 'This is my first floor plan',
            'project_url' => '2fv03b',
            'created_at' => '2017-03-23T15:48:19.000Z',
            'updated_at' => '2017-03-23T15:48:19.000Z',
            'enable_autosave' => false,
            'external_identifier' => 'ID3344',
            'exported_at' => null,
        ];

        $handler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        $httpClient = new Client(['handler' => $handler]);

        $result = $this->client->projects($httpClient)->create([
            'project' => [
                'name' => 'My new house',
                'description' => 'This is my first floor plan',
                'external_identifier' => 'ID3344',
            ],
        ]);

        $this->assertEquals($response, $result);
    }

    /**
     * @covers ::index
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testIndex(): void
    {
        $response = [
            [
                'id' => 170280,
                'user_id' => 103,
                'public' => false,
                'name' => 'My new house',
                'description' => 'This is my first floor plan',
                'project_url' => '2fv03b',
                'created_at' => '2017-03-23T15:48:19.000Z',
                'updated_at' => '2017-03-23T15:48:19.000Z',
                'enable_autosave' => false,
                'external_identifier' => 'ID3344',
                'exported_at' => null,
            ],
        ];

        $handler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        $httpClient = new Client(['handler' => $handler]);

        $result = $this->client->projects($httpClient)->index();

        $this->assertEquals($response, $result);
    }

    /**
     * @covers ::show
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testShow(): void
    {
        $response = [
            'id' => 170280,
            'user_id' => 103,
            'public' => false,
            'name' => 'My new house',
            'description' => 'This is my first floor plan',
            'project_url' => '2fv03b',
            'created_at' => '2017-03-23T15:48:19.000Z',
            'updated_at' => '2017-03-23T15:48:19.000Z',
            'enable_autosave' => false,
            'external_identifier' => 'ID3344',
            'exported_at' => null,
        ];

        $handler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        $httpClient = new Client(['handler' => $handler]);

        $result = $this->client->projects($httpClient)->show(170280);

        $this->assertEquals($response, $result);
    }

    /**
     * @covers ::update
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testUpdate(): void
    {
        $response = [
            'id' => 170280,
            'user_id' => 103,
            'public' => false,
            'name' => 'My new house',
            'description' => 'This is my first floor plan',
            'project_url' => '2fv03b',
            'created_at' => '2017-03-23T15:48:19.000Z',
            'updated_at' => '2017-03-23T15:48:19.000Z',
            'enable_autosave' => false,
            'external_identifier' => 'ID3344',
            'exported_at' => null,
        ];

        $handler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        $httpClient = new Client(['handler' => $handler]);

        $result = $this->client->projects($httpClient)->update(170280, [
            'public' => false,
            'name' => 'My new house',
            'description' => 'This is my first floor plan',
            'external_identifier' => 'ID3344',
        ]);

        $this->assertEquals($response, $result);
    }

    /**
     * @covers ::destroy
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testDestroy(): void
    {
        $handler = new MockHandler([
            new Response(200),
        ]);

        $httpClient = new Client(['handler' => $handler]);

        $result = $this->client->projects($httpClient)->destroy(170280);

        $this->assertTrue($result);
    }

    /**
     * @covers ::export
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testExport(): void
    {
        $handler = new MockHandler([
            new Response(200),
        ]);

        $httpClient = new Client(['handler' => $handler]);

        $result = $this->client->projects($httpClient)->export(170280, [
            'id' => 1,
            'designs' => [
                32144,
                32146,
            ],
            'fmt' => [
                'jpg',
            ],
            'width' => 960,
            'height' => 540,
            'type' => '2d',
            'paper' => [
                'combine' => false,
                'orientation' => 'landscape',
                'size' => null,
                'scale' => null,
                'visuals' => 'BW',
                'logo' => [
                    'url' => 'http://example.org/image.png',
                    'position' => 'BR',
                    'scale' => 0.99,
                ],
                'margins' => [
                    'top' => 15,
                    'left' => 15,
                    'bottom' => 15,
                    'right' => 15,
                ],
                'scalebar' => [
                    'height' => 4,
                    'width' => 100,
                    'div' => 5,
                ],
            ],
        ]);

        $this->assertTrue($result);
    }
}
