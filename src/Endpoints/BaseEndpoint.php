<?php
declare(strict_types=1);

namespace SooMedia\Floorplanner\Endpoints;

use GuzzleHttp\ClientInterface;

/**
 * Class BaseEndpoint
 *
 * @package SooMedia\Floorplanner\Endpoints
 */
abstract class BaseEndpoint
{
    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $httpClient;

    /**
     * Projects constructor.
     *
     * @param \GuzzleHttp\ClientInterface $httpClient
     */
    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }
}
