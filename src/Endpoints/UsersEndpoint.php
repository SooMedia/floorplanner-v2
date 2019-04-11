<?php
declare(strict_types=1);

namespace SooMedia\Floorplanner\Endpoints;

/**
 * Class UsersEndpoint
 *
 * @package SooMedia\Floorplanner\Endpoints
 */
class UsersEndpoint extends BaseEndpoint
{
    /**
     * Create a new user.
     *
     * @param  array $params
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerServerException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerClientException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#create
     */
    public function create(array $params): array
    {
        $response = $this->makeRequest('POST', 'users.json', [
            'json' => $params,
        ]);

        return $this->processJsonResponse($response);
    }

    /**
     * List a page of users.
     *
     * @param  int  $page
     * @param  int  $perPage
     * @param  bool $profile
     * @param  bool $company
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerServerException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerClientException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#index
     */
    public function index(
        int $page = 1,
        int $perPage = 50,
        bool $profile = false,
        bool $company = false
    ): array {
        $response = $this->makeRequest('GET', 'users.json', [
            'query' => [
                'page' => $page,
                'per_page' => $perPage,
                'profile' => $profile,
                'company' => $company,
            ],
        ]);

        return $this->processJsonResponse($response);
    }

    /**
     * Search users by their email.
     *
     * @param  string $email
     * @param  int    $page
     * @param  int    $perPage
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerClientException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerServerException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#search
     */
    public function search(
        string $email,
        int $page = 1,
        int $perPage = 50
    ): array {
        $response = $this->makeRequest('GET', 'users/search.json', [
            'query' => [
                'page' => $page,
                'per_page' => $perPage,
                'email' => $email,
            ],
        ]);

        return $this->processJsonResponse($response);
    }

    /**
     * Show a user.
     *
     * @param  int $identifier
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerServerException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerClientException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#show
     */
    public function show(int $identifier): array
    {
        $response = $this->makeRequest('GET', 'users/' . $identifier . '.json');

        return $this->processJsonResponse($response);
    }

    /**
     * Update a user.
     *
     * @param  int    $identifier
     * @param  array  $params
     * @param  string $method
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerServerException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerClientException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#update
     */
    public function update(
        int $identifier,
        array $params,
        string $method = 'PUT'
    ): array {
        $response = $this->makeRequest(
            $method,
            'users/' . $identifier . '.json',
            [
                'json' => $params,
            ]
        );

        return $this->processJsonResponse($response);
    }

    /**
     * Destroy a user.
     *
     * @param  int $identifier
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerServerException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerClientException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#destroy
     */
    public function destroy(int $identifier): bool
    {
        $this->makeRequest('DELETE', 'users/' . $identifier . '.json');

        return true;
    }

    /**
     * Get a user's token.
     *
     * @param  int $identifier
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerServerException
     * @throws \SooMedia\Floorplanner\Exceptions\FloorplannerClientException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#token
     */
    public function token(int $identifier): array
    {
        $response = $this->makeRequest(
            'GET',
            'users/' . $identifier . '/token.json'
        );

        return $this->processJsonResponse($response);
    }
}
