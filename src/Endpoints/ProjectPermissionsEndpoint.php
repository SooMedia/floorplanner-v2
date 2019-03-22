<?php
declare(strict_types=1);

namespace SooMedia\Floorplanner\Endpoints;

/**
 * Class ProjectPermissionsEndpoint
 *
 * @package SooMedia\Floorplanner\Endpoints
 */
class ProjectPermissionsEndpoint extends BaseEndpoint
{
    /**
     * Create new permissions for a project.
     *
     * @param  int   $projectId
     * @param  array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerServerException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerClientException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#create-2
     */
    public function create(int $projectId, array $params): array
    {
        $response = $this->makeRequest('POST', $this->buildUri($projectId), [
            'json' => $params,
        ]);

        return $this->processJsonResponse($response);
    }

    /**
     * Get the list of the permissions for a project.
     *
     * @param  int $projectId
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerServerException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerClientException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#index-2
     */
    public function index(int $projectId): array
    {
        $response = $this->makeRequest('GET', $this->buildUri($projectId));

        return $this->processJsonResponse($response);
    }

    /**
     * Show a permission for a project.
     *
     * @param  int $projectId
     * @param  int $permissionId
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerServerException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerClientException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#show-1
     */
    public function show(int $projectId, int $permissionId): array
    {
        $response = $this->makeRequest(
            'GET',
            $this->buildUri($projectId, $permissionId)
        );

        return $this->processJsonResponse($response);
    }

    /**
     * Update a permission for a project.
     *
     * @param  int    $projectId
     * @param  int    $permissionId
     * @param  array  $params
     * @param  string $method
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerServerException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerClientException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#update-2
     */
    public function update(
        int $projectId,
        int $permissionId,
        array $params,
        string $method = 'PUT'
    ): array {
        $response = $this->makeRequest(
            $method,
            $this->buildUri($projectId, $permissionId),
            [
                'json' => $params,
            ]
        );

        return $this->processJsonResponse($response);
    }

    /**
     * Destroy a permission for a project.
     *
     * @param  int $projectId
     * @param  int $permissionId
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerServerException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerClientException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#destroy-2
     */
    public function destroy(int $projectId, int $permissionId): bool
    {
        $this->makeRequest(
            'DELETE',
            $this->buildUri($projectId, $permissionId)
        );

        return true;
    }

    /**
     * Build the URI for requests to the project permissions endpoint.
     *
     * @param  int      $projectId
     * @param  int|null $permissionId
     * @return string
     */
    public function buildUri(
        int $projectId,
        int $permissionId = null
    ): string {
        $parts = [
            'projects',
            $projectId,
            'permissions',
        ];

        if ($permissionId !== null) {
            $parts[] = $permissionId;
        }

        return implode('/', $parts) . '.json';
    }
}
