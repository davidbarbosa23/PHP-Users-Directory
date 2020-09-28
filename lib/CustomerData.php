<?php

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\RequestException;

class CustomerData
{
    /**
     * Guzzle HTTP Client
     *
     * @var \GuzzleHttp\Client
     */
    protected $http;

    public function __construct()
    {
        ignore_user_abort(true);
        $this->http = new Guzzle;
    }

    /**
     * Perform a request
     *
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return mixed
     */
    public function request(string $method, string $uri, array $options = [])
    {
        if (isset($options['token'])) {
            $options['headers']['Authorization'] = $options['token'];
        }

        $request = $this->http->request($method, $uri, $options);

        if ($request->getStatusCode() == 200) {
            return json_decode(
                (string) $request->getBody(), true
            );
        }
        
        return false;
    }

    /**
     * Perform an asynchronous request
     *
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return mixed
     */
    public function requestAsync(string $method, string $uri, array $options = [])
    {
        if (isset($options['token'])) {
            $options['headers']['Authorization'] = $options['token'];
        }

        $promise = $this->http->requestAsync($method, $uri, $options);

        return $promise->then(
            function (Response $resp) {
                return $resp->getBody();
            },
            function (RequestException $e) {
                return false;
            }
        );

        $promise->wait();
    }
}
