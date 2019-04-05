<?php
declare(strict_types=1);

namespace SooMedia\Floorplanner\Endpoints;

/**
 * Class ProjectsEndpoint
 *
 * @package SooMedia\Floorplanner\Endpoints
 */
class ProjectsEndpoint extends BaseEndpoint
{
    /**
     * Create a new project.
     *
     * @param  array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerServerException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerClientException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#create-1
     */
    public function create(array $params): array
    {
        $response = $this->makeRequest('POST', 'projects.json', [
            'json' => $params,
        ]);

        return $this->processJsonResponse($response);
    }

    /**
     * List a page of projects.
     *
     * @param  int $page
     * @param  int $perPage
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerServerException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerClientException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#index-1
     */
    public function index(int $page = 1, int $perPage = 50): array
    {
        $response = $this->makeRequest('GET', 'projects.json', [
            'query' => [
                'page' => $page,
                'per_page' => $perPage,
            ],
        ]);

        return $this->processJsonResponse($response);
    }

    /**
     * Show a project.
     *
     * @param  int $identifier
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerServerException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerClientException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#show-json--fml
     */
    public function show(int $identifier): array
    {
        $response = $this->makeRequest(
            'GET',
            'projects/' . $identifier . '.json'
        );

        return $this->processJsonResponse($response);
    }

    /**
     * Show the project's FML.
     *
     * @param  int $identifier
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerClientException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerServerException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#show-json--fml
     */
    public function showFml(int $identifier): string
    {
        $response = $this->makeRequest(
            'GET',
            'projects/' . $identifier . '.fml'
        );

        return (string) $response->getBody();
    }

    /**
     * Update a project.
     *
     * @param  int    $identifier
     * @param  array  $params
     * @param  string $method
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerServerException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerClientException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#update-1
     */
    public function update(
        int $identifier,
        array $params,
        string $method = 'PUT'
    ): array {
        $response = $this->makeRequest(
            $method,
            'projects/' . $identifier . '.json',
            [
                'json' => $params,
            ]
        );

        return $this->processJsonResponse($response);
    }

    /**
     * Destroy a project.
     *
     * @param  int $identifier
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerServerException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerClientException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#destroy-1
     */
    public function destroy(int $identifier): bool
    {
        $this->makeRequest(
            'DELETE',
            'projects/' . $identifier . '.json'
        );

        return true;
    }

    /**
     * Export the project.
     *
     * @param  int   $identifier
     * @param  array $params
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerServerException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerClientException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#export-2d
     */
    public function export(int $identifier, array $params): bool
    {
        $this->makeRequest(
            'POST',
            'projects/' . $identifier . '/export.json',
            [
                'json' => $params,
            ]
        );

        return true;
    }
}
