<?php

namespace SooMedia\Floorplanner;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use SooMedia\Floorplanner\Endpoints\ProjectsEndpoint;

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
    protected static $baseUri = 'https://floorplanner.com/api/v2';

    /**
     * @var string
     */
    protected $apiKey;

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
     * @param array  $httpClientOptions
     */
    public function __construct(string $apiKey, array $httpClientOptions = [])
    {
        $this->apiKey = $apiKey;

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
                    'base_uri' => self::$baseUri,
                    'auth' => [$this->apiKey, 'x'],
                ],
                $this->httpClientOptions
            );

            $this->httpClient = new Client($config);
        }

        return $this->httpClient;
    }

    /**
     * Get the projects endpoint.
     *
     * @param  ClientInterface|null $httpClient
     * @return ProjectsEndpoint
     */
    public function projects(?ClientInterface $httpClient = null): ProjectsEndpoint
    {
        $httpClient = $httpClient ?: $this->getHttpClient();

        return new ProjectsEndpoint($httpClient);
    }
}