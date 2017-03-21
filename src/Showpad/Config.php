<?php
/**
 * This file was inherited and adapted from the turanct/showpad-api library
 */

namespace Showpad;

/**
 * Basic Configuration
 */
class Config implements ConfigInterface
{
    /**
     * @var string The client id
     */
    protected $clientId;

    /**
     * @var string The username
     */
    protected $username;

    /**
     * @var string The password
     */
    protected $password;

    /**
     * @var string The client secret
     */
    protected $clientSecret;

    /**
     * @var string The access token
     */
    protected $accessToken;

    /**
     * @var string The refresh token
     */
    protected $refreshToken;

    /**
     * @var string The api endpoint
     */
    protected $endpoint;

    /**
     * Construct
     *
     * @param string $endpoint     The api endpoint
     * @param string $clientId     The client id
     * @param string $clientSecret The client secret
     * @param string $accessToken  The access token
     * @param string $refreshToken The refresh token
     */
    public function __construct($endpoint, $username, $password, $clientId, $clientSecret, $accessToken = null, $refreshToken = null)
    {
        $this->endpoint = (string) $endpoint;
        $this->username = (string) $username;
        $this->password = (string) $password;
        $this->clientId = (string) $clientId;
        $this->clientSecret = (string) $clientSecret;
        $this->accessToken = (string) $accessToken;
        $this->refreshToken = (string) $refreshToken;
    }

    /**
     * Update access token
     *
     * @param string $accessToken The access token
     *
     * @return void
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = (string) $accessToken;
    }

    /**
     * Update refresh token
     *
     * @param string $refreshToken The refresh token
     *
     * @return void
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = (string) $refreshToken;
    }

    /**
     * Get client id
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get client id
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get client id
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Get client secret
     *
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * Get access token
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Get access token
     *
     * @return string
     */
    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    /**
     * Get access token
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }
}
