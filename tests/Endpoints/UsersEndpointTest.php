<?php

namespace Tests\Endpoints;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use SooMedia\Floorplanner\FloorplannerClient;

/**
 * Class UsersEndpointTest
 *
 * @package Tests\Endpoints
 * @coversDefaultClass \SooMedia\Floorplanner\Endpoints\UsersEndpoint
 */
class UsersEndpointTest extends TestCase
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

        $handler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        $httpClient = new Client(['handler' => $handler]);

        $result = $this->client->users($httpClient)->create([
            'user' => [
                'email' => 'some@email.woohoo',
                'password' => 'sent-over-https',
                'measurement_system' => 'METRIC',
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

        $handler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        $httpClient = new Client(['handler' => $handler]);

        $result = $this->client->users($httpClient)->index();

        $this->assertEquals($response, $result);
    }

    /**
     * @covers ::show
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testShow(): void
    {
        $response = [
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

        $handler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        $httpClient = new Client(['handler' => $handler]);

        $result = $this->client->users($httpClient)->show(6);

        $this->assertEquals($response, $result);
    }

    /**
     * @covers ::update
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testUpdate(): void
    {
        $response = [
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

        $handler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        $httpClient = new Client(['handler' => $handler]);

        $result = $this->client->users($httpClient)->update(6, [
            'user' => [
                'email' => 'some@email.woohoo',
                'password' => 'sent_over_https',
                'measurement_system' => 'IMPERIAL',
            ],
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

        $result = $this->client->users($httpClient)->destroy(6);

        $this->assertTrue($result);
    }

    /**
     * @covers ::token
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function testToken(): void
    {
        $response = [
            'id' => 1,
            'token' => '36db96d625be097617dda5624b2550e7',
            'valid_until' => '2017-01-01T12:08:32.000Z',
            'creator_id' => null,
            'comment' => null,
            'user_id' => 5,
            'created_at' => '2015-06-01T14:08:32.000Z',
            'updated_at' => '2016-06-01T14:08:32.000Z',
        ];

        $handler = new MockHandler([
            new Response(200, [], json_encode($response)),
        ]);

        $httpClient = new Client(['handler' => $handler]);

        $result = $this->client->users($httpClient)->token(6);

        $this->assertEquals($response, $result);
    }
}
