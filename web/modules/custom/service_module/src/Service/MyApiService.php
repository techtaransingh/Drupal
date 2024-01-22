<?php

namespace Drupal\service_module\Service;

use GuzzleHttp\ClientInterface;

class MyApiService
{

    protected $httpClient;

    /**
     * Constructor for MymoduleServiceExample.
     *
     * @param \GuzzleHttp\ClientInterface $http_client
     *   A Guzzle client object.
     */

    public function __construct(ClientInterface $http_client)
    {


        $this->httpClient = $http_client;

    }

    public function callApi($url, $method = 'GET', $data = [])
    {

        $response = $this->httpClient->request($method, $url, ['json' => $data]);

        // Handle the API response as needed.
        $statusCode = $response->getStatusCode();
        $content = $response->getBody();

        // Example: Return decoded JSON content.
        return json_decode($content);
    }
}