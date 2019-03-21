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
    public const BASE_URI = 'https://floorplanner.com/';

    /**
     * @var string
     */
    public const API_ENDPOINT = 'api/v2/';

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $baseUri;

    /**
     * @var string
     */
    protected $apiEndpoint;

    /**
     * @var array
     */
    protected $httpClientOptions;

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $httpClient;

    /**
     * FloorplannerClient constructor.
     *
     * @param string $apiKey
     * @param string $baseUri
     * @param string $apiEndpoint
     * @param array  $httpClientOptions
     */
    public function __construct(
        string $apiKey,
        string $baseUri = self::BASE_URI,
        string $apiEndpoint = self::API_ENDPOINT,
        array $httpClientOptions = []
    ) {
        $this->apiKey = $apiKey;

        $this->baseUri = $baseUri;

        $this->apiEndpoint = $apiEndpoint;

        $this->httpClientOptions = $httpClientOptions;
    }

    /**
     * Get the HTTP client.
     *
     * @return \GuzzleHttp\ClientInterface
     */
    public function getHttpClient(): ClientInterface
    {
        if (!isset($this->httpClient)) {
            $config = array_merge(
                [
                    'base_uri' => $this->buildBaseUri(),
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
     * @param  \GuzzleHttp\ClientInterface|null $httpClient
     * @return \SooMedia\Floorplanner\Endpoints\UsersEndpoint
     */
    public function users(ClientInterface $httpClient = null): UsersEndpoint
    {
        $httpClient = $httpClient ?: $this->getHttpClient();

        return new UsersEndpoint($httpClient);
    }

    /**
     * Get the projects endpoint.
     *
     * @param  \GuzzleHttp\ClientInterface|null $httpClient
     * @return \SooMedia\Floorplanner\Endpoints\ProjectsEndpoint
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
     * @param  \GuzzleHttp\ClientInterface|null $httpClient
     * @return \SooMedia\Floorplanner\Endpoints\ProjectPermissionsEndpoint
     */
    public function projectPermissions(
        ClientInterface $httpClient = null
    ): ProjectPermissionsEndpoint {
        $httpClient = $httpClient ?: $this->getHttpClient();

        return new ProjectPermissionsEndpoint($httpClient);
    }

    /**
     * Get the API key.
     *
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * Get the base URI.
     *
     * @return string
     */
    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    /**
     * Get the API endpoint.
     *
     * @return string
     */
    public function getApiEndpoint(): string
    {
        return $this->apiEndpoint;
    }

    /**
     * Get the HTTP client options.
     *
     * @return array
     */
    public function getHttpClientOptions(): array
    {
        return $this->httpClientOptions;
    }

    /**
     * Get the base URI with the API base endpoint attached.
     *
     * @return string
     */
    protected function buildBaseUri(): string
    {
        return rtrim($this->baseUri, '/') . '/' . $this->apiEndpoint;
    }
}
