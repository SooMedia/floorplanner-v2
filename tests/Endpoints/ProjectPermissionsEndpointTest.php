<?php
declare(strict_types=1);

namespace Tests\Endpoints;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use SooMedia\Floorplanner\FloorplannerClient;

/**
 * Class ProjectPermissionsEndpointTest
 *
 * @package Tests\Endpoints
 * @coversDefaultClass \SooMedia\Floorplanner\Endpoints\ProjectPermissionsEndpoint
 */
class ProjectPermissionsEndpointTest extends EndpointTestCase
{
    /**
     * @covers ::create
     * @covers ::makeRequest
     * @covers ::processJsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerServerException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerClientException
     */
    public function testCreate(): void
    {
        $requestBody = [
            'permission' => [
                'user_id' => 103,
                'comment' => 'Shared project because for client XXXXX',
            ],
        ];

        $responseBody = [
            'id' => 170280,
            'user_id' => 103,
            'project_id' => 3434343,
            'comment' => 'Shared project because for client XXXXX',
            'created_at' => '2017-03-23T15:48:19.000Z',
            'updated_at' => '2017-03-23T15:48:19.000Z',
        ];

        $container = [];

        $client = $this->getClient([
            new Response(200, [], json_encode($responseBody)),
        ], $container);

        $result = $client->projectPermissions()->create(3434343, $requestBody);

        $this->assertEquals($responseBody, $result);
        $this->assertCount(1, $container);

        $transaction = $container[0];

        /** @var Request $request */
        $request = $transaction['request'];

        $this->validateRequest(
            $request,
            'POST',
            'https://floorplanner.com/api/v2/projects/3434343/permissions.json',
            [
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode('mock_api_key:x'),
            ],
            json_encode($requestBody)
        );
    }

    /**
     * @covers ::index
     * @covers ::makeRequest
     * @covers ::processJsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerServerException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerClientException
     */
    public function testIndex(): void
    {
        $responseBody = [
            [
                'id' => 170280,
                'user_id' => 103,
                'project_id' => 3434343,
                'comment' => 'Shared project because for client XXXXX',
                'created_at' => '2017-03-23T15:48:19.000Z',
                'updated_at' => '2017-03-23T15:48:19.000Z',
            ],
        ];

        $container = [];

        $client = $this->getClient([
            new Response(200, [], json_encode($responseBody)),
        ], $container);

        $result = $client->projectPermissions()->index(3434343);

        $this->assertEquals($responseBody, $result);
        $this->assertCount(1, $container);

        $transaction = $container[0];

        /** @var Request $request */
        $request = $transaction['request'];

        $this->validateRequest(
            $request,
            'GET',
            'https://floorplanner.com/api/v2/projects/3434343/permissions.json',
            [
                'Authorization' => 'Basic ' . base64_encode('mock_api_key:x'),
            ]
        );
    }

    /**
     * @covers ::show
     * @covers ::makeRequest
     * @covers ::processJsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerServerException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerClientException
     */
    public function testShow(): void
    {
        $responseBody = [
            'id' => 170280,
            'user_id' => 103,
            'project_id' => 3434343,
            'comment' => 'Shared project because for client XXXXX',
            'created_at' => '2017-03-23T15:48:19.000Z',
            'updated_at' => '2017-03-23T15:48:19.000Z',
        ];

        $container = [];

        $client = $this->getClient([
            new Response(200, [], json_encode($responseBody)),
        ], $container);

        $result = $client->projectPermissions()->show(3434343, 170280);

        $this->assertEquals($responseBody, $result);
        $this->assertCount(1, $container);

        $transaction = $container[0];

        /** @var Request $request */
        $request = $transaction['request'];

        $this->validateRequest(
            $request,
            'GET',
            'https://floorplanner.com/api/v2/projects/3434343/permissions/170280.json',
            [
                'Authorization' => 'Basic ' . base64_encode('mock_api_key:x'),
            ]
        );
    }

    /**
     * @covers ::update
     * @covers ::makeRequest
     * @covers ::processJsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerServerException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerClientException
     */
    public function testUpdate(): void
    {
        $requestBody = [
            'permission' => [
                'user_id' => 104,
                'comment' => 'Changed permissions for user 103',
            ],
        ];

        $responseBody = [
            'id' => 170280,
            'user_id' => 104,
            'project_id' => 3434343,
            'comment' => 'Changed permissions for user 103',
            'created_at' => '2017-03-23T15:48:19.000Z',
            'updated_at' => '2017-03-23T15:48:19.000Z',
        ];

        $container = [];

        $client = $this->getClient([
            new Response(200, [], json_encode($responseBody)),
        ], $container);

        $result = $client->projectPermissions()->update(
            3434343,
            170280,
            $requestBody
        );

        $this->assertEquals($responseBody, $result);
        $this->assertCount(1, $container);

        $transaction = $container[0];

        /** @var Request $request */
        $request = $transaction['request'];

        $this->validateRequest(
            $request,
            'PUT',
            'https://floorplanner.com/api/v2/projects/3434343/permissions/170280.json',
            [
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode('mock_api_key:x'),
            ],
            json_encode($requestBody)
        );
    }

    /**
     * @covers ::destroy
     * @covers ::makeRequest
     * @covers ::processJsonResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerServerException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerClientException
     */
    public function testDestroy(): void
    {
        $container = [];

        $client = $this->getClient([
            new Response(200),
        ], $container);

        $result = $client->projectPermissions()->destroy(3434343, 170280);

        $this->assertTrue($result);
        $this->assertCount(1, $container);

        $transaction = $container[0];

        /** @var Request $request */
        $request = $transaction['request'];

        $this->validateRequest(
            $request,
            'DELETE',
            'https://floorplanner.com/api/v2/projects/3434343/permissions/170280.json',
            [
                'Authorization' => 'Basic ' . base64_encode('mock_api_key:x'),
            ]
        );
    }

    /**
     * @param  string   $uri
     * @param  int      $projectId
     * @param  int|null $permissionId
     * @covers ::buildUri
     * @dataProvider buildUriProvider
     */
    public function testBuildUri(
        string $uri,
        int $projectId,
        int $permissionId = null
    ): void {
        $client = new FloorplannerClient('mock_api_key');

        $result = $client->projectPermissions()->buildUri(
            $projectId,
            $permissionId
        );

        $this->assertSame($uri, $result);
    }

    /**
     * @return array
     */
    public function buildUriProvider(): array
    {
        return [
            ['projects/123/permissions.json', 123, null],
            ['projects/123/permissions/321.json', 123, 321],
        ];
    }
}
