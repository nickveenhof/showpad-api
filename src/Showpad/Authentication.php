<?php

namespace Showpad;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 * Basic Authentication Client
 */
class Authentication
{
    /**
     * @var \Showpad\ConfigInterface The configuration object
     */
    protected $config;

    /**
     * @var \GuzzleHttp\Client http client
     */
    protected $httpClient;

    /**
     * Construct
     *
     * @param ConfigInterface $config The config object
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
        $this->httpClient = new Client();
    }

    /**
     * Authentication
     *
     * This method will request our access tokens using our username and password
     *
     * @return string New token pair
     */
    public function authenticate()
    {
        $resource = $this->config->getEndpoint() . '/oauth2/token';

        $body = array(
            'grant_type' => 'password',
            'username' => $this->config->getUsername(),
            'password' => $this->config->getPassword()
        );

        $headers =  array(
            'Authorization' => 'Basic ' . base64_encode($this->config->getClientId() . ':' . $this->config->getClientSecret())
        );

        $response = $this->httpClient->post($resource, array('form_params' => $body, 'headers' => $headers));
        $data = json_decode($response->getBody(), true);

        // Overwrite $this->config with new settings
        $this->config->setAccessToken($data['access_token']);
        $this->config->setRefreshToken($data['refresh_token']);

        // Return token data
        return $data;
    }

    /**
     * Send an authenticated api request
     *
     * @param string $method     The HTTP method
     * @param string $endpoint   The api endpoint to send the request to
     * @param array  $parameters The parameters for the request (assoc array)
     *
     * @throws RequestException
     *
     * @return mixed
     */
    public function request($method, $endpoint, array $parameters = null)
    {

        $resource = $this->config->getEndpoint() . $endpoint;

        // Client should always send OAuth2 tokens in its headers
        $headers = array('Authorization' => 'Bearer ' . $this->config->getAccessToken());

        $parameters['headers'] = $headers;
        try {
          $response = $this->httpClient->request($method, $resource, $parameters);
        }
        catch (RequestException $e) {
          // Debugging purposes
          //var_dump($e->getResponse()->getBody()->getContents());
        }


        $data = json_decode($response->getBody(), true);

        return $data;
    }
}
