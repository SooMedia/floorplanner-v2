<?php

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
     * @see http://docs.floorplanner.com/floorplanner/api-v2#create-1
     */
    public function create(array $params): array
    {
        $response = $this->httpClient->request('POST', '/projects.json', [
            'json' => $params,
        ]);

        $json = $response->getBody();

        return json_decode($json, true);
    }

    /**
     * Show a project.
     *
     * @param  int    $identifier
     * @param  string $format
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#show-json--fml
     */
    public function show(int $identifier, string $format = 'json'): array
    {
        $uri = 'projects/' . $identifier . '.' . $format;

        $response = $this->httpClient->request('GET', $uri);

        $json = $response->getBody();

        return json_decode($json, true);
    }

    /**
     * List a page of projects.
     *
     * @param  int $page
     * @param  int $perPage
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#index-1
     */
    public function index(int $page = 1, int $perPage = 50): array
    {
        $response = $this->httpClient->request('GET', 'projects.json', [
            'query' => [
                'page' => $page,
                'per_page' => $perPage,
            ],
        ]);

        $json = $response->getBody();

        return json_decode($json, true);
    }

    /**
     * Update a project.
     *
     * @param  int    $identifier
     * @param  array  $params
     * @param  string $method
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#update-1
     */
    public function update(
        int $identifier,
        array $params,
        string $method = 'PUT'
    ): array {
        $uri = 'projects/' . $identifier . '.json';

        $response = $this->httpClient->request($method, $uri, [
            'json' => $params,
        ]);

        $json = $response->getBody();

        return json_decode($json, true);
    }

    /**
     * Destroy a project.
     *
     * @param  int $identifier
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#destroy-1
     */
    public function destroy(int $identifier): bool
    {
        $uri = 'projects/' . $identifier . '.json';

        $this->httpClient->request('DELETE', $uri);

        return true;
    }

    /**
     * Export the project.
     *
     * @param  int   $identifier
     * @param  array $params
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#export-2d
     */
    public function export(int $identifier, array $params): bool
    {
        $uri = 'projects/' . $identifier . '/export.json';

        $this->httpClient->request('POST', $uri, [
            'json' => $params,
        ]);

        return true;
    }
}
