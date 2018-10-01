<?php
declare(strict_types=1);

namespace Tests\Endpoints;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

/**
 * Class UsersEndpointTest
 *
 * @package Tests\Endpoints
 * @coversDefaultClass \SooMedia\Floorplanner\Endpoints\UsersEndpoint
 */
class UsersEndpointTest extends EndpointTestCase
{
    /**
     * @covers ::create
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testCreate(): void
    {
        $requestBody = [
            'user' => [
                'email' => 'some@email.woohoo',
                'password' => 'sent-over-https',
                'measurement_system' => 'METRIC',
            ],
        ];

        $responseBody = [
            'country_code' => null,
            'created_at' => '2015-06-01T14:08:32.000Z',
            'creator_id' => null,
            'currency' => null,
            'email' => 'some@email.test',
            'external_identifier' => 'ID12346',
            'id' => 6,
            'language' => null,
            'last_seen_at' => null,
            'measurement_system' => 'METRIC',
            'parent_id' => 5,
            'updated_at' => '2016-06-01T14:08:32.000Z',
            'role' => 'subuser',
        ];

        $container = [];

        $client = $this->getClient([
            new Response(200, [], json_encode($responseBody)),
        ], $container);

        $result = $client->users()->create($requestBody);

        $this->assertEquals($responseBody, $result);
        $this->assertCount(1, $container);

        $transaction = $container[0];

        /** @var Request $request */
        $request = $transaction['request'];

        $this->validateRequest(
            $request,
            'POST',
            'https://floorplanner.com/api/v2/users.json',
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
                'country_code' => null,
                'created_at' => '2015-06-01T14:08:32.000Z',
                'creator_id' => null,
                'currency' => null,
                'email' => 'some@email.test',
                'external_identifier' => 'ID12346',
                'id' => 6,
                'language' => null,
                'last_seen_at' => null,
                'measurement_system' => 'METRIC',
                'parent_id' => 5,
                'updated_at' => '2016-06-01T14:08:32.000Z',
                'role' => 'free',
            ],
        ];

        $container = [];

        $client = $this->getClient([
            new Response(200, [], json_encode($responseBody)),
        ], $container);

        $result = $client->users()->index();

        $this->assertEquals($responseBody, $result);
        $this->assertCount(1, $container);

        $transaction = $container[0];

        /** @var Request $request */
        $request = $transaction['request'];

        $this->validateRequest(
            $request,
            'GET',
            'https://floorplanner.com/api/v2/users.json?page=1&per_page=50&profile=0&company=0',
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
            'country_code' => null,
            'created_at' => '2015-06-01T14:08:32.000Z',
            'creator_id' => null,
            'currency' => null,
            'email' => 'some@email.test',
            'external_identifier' => 'ID12346',
            'id' => 6,
            'language' => null,
            'last_seen_at' => null,
            'measurement_system' => 'METRIC',
            'parent_id' => 5,
            'profile' => [],
            'company' => [],
            'updated_at' => '2016-06-01T14:08:32.000Z',
        ];

        $container = [];

        $client = $this->getClient([
            new Response(200, [], json_encode($responseBody)),
        ], $container);

        $result = $client->users()->show(6);

        $this->assertEquals($responseBody, $result);
        $this->assertCount(1, $container);

        $transaction = $container[0];

        /** @var Request $request */
        $request = $transaction['request'];

        $this->validateRequest(
            $request,
            'GET',
            'https://floorplanner.com/api/v2/users/6.json',
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
            'user' => [
                'email' => 'some@email.woohoo',
                'password' => 'sent_over_https',
                'measurement_system' => 'IMPERIAL',
            ],
        ];

        $responseBody = [
            'country_code' => null,
            'created_at' => '2015-06-01T14:08:32.000Z',
            'creator_id' => null,
            'currency' => null,
            'email' => 'some@email.woohoo',
            'external_identifier' => 'ID12346',
            'id' => 6,
            'language' => null,
            'last_seen_at' => null,
            'measurement_system' => 'IMPERIAL',
            'parent_id' => 5,
            'updated_at' => '2016-06-01T14:08:32.000Z',
        ];

        $container = [];

        $client = $this->getClient([
            new Response(200, [], json_encode($responseBody)),
        ], $container);

        $result = $client->users()->update(6, $requestBody);

        $this->assertEquals($responseBody, $result);
        $this->assertCount(1, $container);

        $transaction = $container[0];

        /** @var Request $request */
        $request = $transaction['request'];

        $this->validateRequest(
            $request,
            'PUT',
            'https://floorplanner.com/api/v2/users/6.json',
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

        $result = $client->users()->destroy(6);

        $this->assertTrue($result);
        $this->assertCount(1, $container);

        $transaction = $container[0];

        /** @var Request $request */
        $request = $transaction['request'];

        $this->validateRequest(
            $request,
            'DELETE',
            'https://floorplanner.com/api/v2/users/6.json',
            [
                'Authorization' => 'Basic ' . base64_encode('mock_api_key:x'),
            ]
        );
    }

    /**
     * @covers ::token
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testToken(): void
    {
        $responseBody = [
            'id' => 1,
            'token' => '36db96d625be097617dda5624b2550e7',
            'valid_until' => '2017-01-01T12:08:32.000Z',
            'creator_id' => null,
            'comment' => null,
            'user_id' => 5,
            'created_at' => '2015-06-01T14:08:32.000Z',
            'updated_at' => '2016-06-01T14:08:32.000Z',
        ];

        $container = [];

        $client = $this->getClient([
            new Response(200, [], json_encode($responseBody)),
        ], $container);

        $result = $client->users()->token(6);

        $this->assertEquals($responseBody, $result);
        $this->assertCount(1, $container);

        $transaction = $container[0];

        /** @var Request $request */
        $request = $transaction['request'];

        $this->validateRequest(
            $request,
            'GET',
            'https://floorplanner.com/api/v2/users/6/token.json',
            [
                'Authorization' => 'Basic ' . base64_encode('mock_api_key:x'),
            ]
        );
    }
}
