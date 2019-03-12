<?php
declare(strict_types=1);

namespace SooMedia\Floorplanner;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use SooMedia\Floorplanner\Endpoints\ProjectPermissionsEndpoint;
use SooMedia\Floorplanner\Endpoints\ProjectsEndpoint;
use SooMedia\Floorplanner\Endpoints\UsersEndpoint;

/**
 * Class FloorplannerClient
 *
 * @package SooMedia\Floorplanner
 */
class FloorplannerClient
{
    /**
     * @var string
     */
    public const BASE_URI = 'https://floorplanner.com/api/v2/';

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $baseUri;

    /**
     * @var array
     */
    protected $httpClientOptions;

    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * FloorplannerClient constructor.
     *
     * @param string $apiKey
     * @param string $baseUri
     * @param array  $httpClientOptions
     */
    public function __construct(
        string $apiKey,
        string $baseUri = self::BASE_URI,
        array $httpClientOptions = []
    ) {
        $this->apiKey = $apiKey;

        $this->baseUri = $baseUri;

        $this->httpClientOptions = $httpClientOptions;
    }

    /**
     * Get the HTTP client.
     *
     * @return ClientInterface
     */
    public function getHttpClient(): ClientInterface
    {
        if (!isset($this->httpClient)) {
            $config = array_merge(
                [
                    'base_uri' => $this->baseUri,
                    'auth' => [$this->apiKey, 'x'],
                ],
                $this->httpClientOptions
            );

            $this->httpClient = new Client($config);
        }

        return $this->httpClient;
    }

    /**
     * Get the users endpoint.
     *
     * @param  ClientInterface|null $httpClient
     * @return UsersEndpoint
     */
    public function users(ClientInterface $httpClient = null): UsersEndpoint
    {
        $httpClient = $httpClient ?: $this->getHttpClient();

        return new UsersEndpoint($httpClient);
    }

    /**
     * Get the projects endpoint.
     *
     * @param  ClientInterface|null $httpClient
     * @return ProjectsEndpoint
     */
    public function projects(
        ClientInterface $httpClient = null
    ): ProjectsEndpoint {
        $httpClient = $httpClient ?: $this->getHttpClient();

        return new ProjectsEndpoint($httpClient);
    }

    /**
     * Get the project permissions endpoint.
     *
     * @param  ClientInterface|null $httpClient
     * @return ProjectPermissionsEndpoint
     */
    public function projectPermissions(
        ClientInterface $httpClient = null
    ): ProjectPermissionsEndpoint {
        $httpClient = $httpClient ?: $this->getHttpClient();

        return new ProjectPermissionsEndpoint($httpClient);
    }
}
