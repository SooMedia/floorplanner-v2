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
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * Projects constructor.
     *
     * @param ClientInterface $httpClient
     */
    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }
}
