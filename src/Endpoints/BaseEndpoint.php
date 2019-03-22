<?php
declare(strict_types=1);

namespace SooMedia\Floorplanner\Endpoints;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Psr\Http\Message\ResponseInterface;
use SooMedia\Floorplanner\Exceptions\FloorplannerClientException;
use SooMedia\Floorplanner\Exceptions\FloorplannerServerException;

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

    /**
     * Make a request to the Floorplanner API.
     *
     * @param  string $method
     * @param  string $uri
     * @param  array  $options
     * @return ResponseInterface
     * @throws FloorplannerServerException
     * @throws FloorplannerClientException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function makeRequest(
        string $method,
        string $uri,
        array $options = []
    ): ResponseInterface {
        try {
            return $this->httpClient->request($method, $uri, $options);
        } catch (ServerException $e) {
            $response = $e->getResponse();

            throw new FloorplannerServerException(
                $this->getExceptionMessage($response),
                $response->getStatusCode(),
                $e
            );
        } catch (ClientException $e) {
            $response = $e->getResponse();

            throw new FloorplannerClientException(
                $this->getExceptionMessage($response),
                $response->getStatusCode(),
                $e
            );
        }
    }

    /**
     * Process the JSON response to an array.
     *
     * @param  ResponseInterface $response
     * @return array
     */
    public function processJsonResponse(ResponseInterface $response): array
    {
        $json = (string) $response->getBody();

        return json_decode($json, true);
    }

    /**
     * Get the exception message from the response.
     *
     * @param  ResponseInterface $response
     * @return string
     */
    protected function getExceptionMessage(ResponseInterface $response): string
    {
        $body = (string) $response->getBody();

        $decoded = json_decode($body, true);

        if ($decoded === null) {
            return $body;
        }

        return $decoded['error'];
    }
}
