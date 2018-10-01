<?php
declare(strict_types=1);

namespace Tests\Endpoints;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

/**
 * Class ProjectsEndpointTest
 *
 * @package Tests\Endpoints
 * @coversDefaultClass \SooMedia\Floorplanner\Endpoints\ProjectsEndpoint
 */
class ProjectsEndpointTest extends EndpointTestCase
{
    /**
     * @covers ::create
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testCreate(): void
    {
        $requestBody = [
            'project' => [
                'name' => 'My new house',
                'description' => 'This is my first floor plan',
                'external_identifier' => 'ID3344',
            ],
        ];

        $responseBody = [
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

        $container = [];

        $client = $this->getClient([
            new Response(200, [], json_encode($responseBody)),
        ], $container);

        $result = $client->projects()->create($requestBody);

        $this->assertEquals($responseBody, $result);
        $this->assertCount(1, $container);

        $transaction = $container[0];

        /** @var Request $request */
        $request = $transaction['request'];

        $this->validateRequest(
            $request,
            'POST',
            'https://floorplanner.com/api/v2/projects.json',
            [
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode('mock_api_key:x'),
            ],
            json_encode($requestBody)
        );
    }

    /**
     * @covers ::index
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testIndex(): void
    {
        $responseBody = [
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

        $container = [];

        $client = $this->getClient([
            new Response(200, [], json_encode($responseBody)),
        ], $container);

        $result = $client->projects()->index();

        $this->assertEquals($responseBody, $result);
        $this->assertCount(1, $container);

        $transaction = $container[0];

        /** @var Request $request */
        $request = $transaction['request'];

        $this->validateRequest(
            $request,
            'GET',
            'https://floorplanner.com/api/v2/projects.json?page=1&per_page=50',
            [
                'Authorization' => 'Basic ' . base64_encode('mock_api_key:x'),
            ]
        );
    }

    /**
     * @covers ::show
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testShow(): void
    {
        $responseBody = [
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

        $container = [];

        $client = $this->getClient([
            new Response(200, [], json_encode($responseBody)),
        ], $container);

        $result = $client->projects()->show(170280);

        $this->assertEquals($responseBody, $result);
        $this->assertCount(1, $container);

        $transaction = $container[0];

        /** @var Request $request */
        $request = $transaction['request'];

        $this->validateRequest(
            $request,
            'GET',
            'https://floorplanner.com/api/v2/projects/170280.json',
            [
                'Authorization' => 'Basic ' . base64_encode('mock_api_key:x'),
            ]
        );
    }

    /**
     * @covers ::update
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testUpdate(): void
    {
        $requestBody = [
            'public' => false,
            'name' => 'My new house',
            'description' => 'This is my first floor plan',
            'external_identifier' => 'ID3344',
        ];

        $responseBody = [
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

        $container = [];

        $client = $this->getClient([
            new Response(200, [], json_encode($responseBody)),
        ], $container);

        $result = $client->projects()->update(170280, $requestBody);

        $this->assertEquals($responseBody, $result);
        $this->assertCount(1, $container);

        $transaction = $container[0];

        /** @var Request $request */
        $request = $transaction['request'];

        $this->validateRequest(
            $request,
            'PUT',
            'https://floorplanner.com/api/v2/projects/170280.json',
            [
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode('mock_api_key:x'),
            ],
            json_encode($requestBody)
        );
    }

    /**
     * @covers ::destroy
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testDestroy(): void
    {
        $container = [];

        $client = $this->getClient([
            new Response(200),
        ], $container);

        $result = $client->projects()->destroy(170280);

        $this->assertTrue($result);
        $this->assertCount(1, $container);

        $transaction = $container[0];

        /** @var Request $request */
        $request = $transaction['request'];

        $this->validateRequest(
            $request,
            'DELETE',
            'https://floorplanner.com/api/v2/projects/170280.json',
            [
                'Authorization' => 'Basic ' . base64_encode('mock_api_key:x'),
            ]
        );
    }

    /**
     * @covers ::export
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testExport(): void
    {
        $requestBody = [
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
        ];

        $container = [];

        $client = $this->getClient([
            new Response(200),
        ], $container);

        $result = $client->projects()->export(170280, $requestBody);

        $this->assertTrue($result);
        $this->assertCount(1, $container);

        $transaction = $container[0];

        /** @var Request $request */
        $request = $transaction['request'];

        $this->validateRequest(
            $request,
            'POST',
            'https://floorplanner.com/api/v2/projects/170280/export.json',
            [
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode('mock_api_key:x'),
            ],
            json_encode($requestBody)
        );
    }
}
