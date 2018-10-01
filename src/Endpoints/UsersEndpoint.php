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
     * @see http://docs.floorplanner.com/floorplanner/api-v2#create
     */
    public function create(array $params): array
    {
        $response = $this->httpClient->request('POST', 'users.json', [
            'json' => $params,
        ]);

        $json = (string) $response->getBody();

        return json_decode($json, true);
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
     * @see http://docs.floorplanner.com/floorplanner/api-v2#index
     */
    public function index(
        int $page = 1,
        int $perPage = 50,
        bool $profile = false,
        bool $company = false
    ): array {
        $response = $this->httpClient->request('GET', 'users.json', [
            'query' => [
                'page' => $page,
                'per_page' => $perPage,
                'profile' => $profile,
                'company' => $company,
            ],
        ]);

        $json = (string) $response->getBody();

        return json_decode($json, true);
    }

    /**
     * Show a user.
     *
     * @param  int $identifier
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#show
     */
    public function show(int $identifier): array
    {
        $uri = 'users/' . $identifier . '.json';

        $response = $this->httpClient->request('GET', $uri);

        $json = (string) $response->getBody();

        return json_decode($json, true);
    }

    /**
     * Update a user.
     *
     * @param  int    $identifier
     * @param  array  $params
     * @param  string $method
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#update
     */
    public function update(
        int $identifier,
        array $params,
        string $method = 'PUT'
    ): array {
        $uri = 'users/' . $identifier . '.json';

        $response = $this->httpClient->request($method, $uri, [
            'json' => $params,
        ]);

        $json = (string) $response->getBody();

        return json_decode($json, true);
    }

    /**
     * Destroy a user.
     *
     * @param  int $identifier
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#destroy
     */
    public function destroy(int $identifier): bool
    {
        $uri = 'users/' . $identifier . '.json';

        $this->httpClient->request('DELETE', $uri);

        return true;
    }

    /**
     * Get a user's token.
     *
     * @param  int $identifier
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @see http://docs.floorplanner.com/floorplanner/api-v2#token
     */
    public function token(int $identifier): array
    {
        $uri = 'users/' . $identifier . '/token.json';

        $response = $this->httpClient->request('GET', $uri);

        $json = (string) $response->getBody();

        return json_decode($json, true);
    }
}
