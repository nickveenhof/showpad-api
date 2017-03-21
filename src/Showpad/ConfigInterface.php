<?php
/**
 * This file was inherited and adapted from the turanct/showpad-api library
 */

namespace Showpad;

/**
 * Configuration interface
 */
interface ConfigInterface
{
    /**
     * Update access token
     *
     * @param string $accessToken The access token
     *
     * @return void
     */
    public function setAccessToken($accessToken);

    /**
     * Update refresh token
     *
     * @param string $refreshToken The refresh token
     *
     * @return void
     */
    public function setRefreshToken($refreshToken);

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername();

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword();

    /**
     * Get client id
     *
     * @return string
     */
    public function getClientId();

    /**
     * Get client secret
     *
     * @return string
     */
    public function getClientSecret();

    /**
     * Get access token
     *
     * @return string
     */
    public function getAccessToken();

    /**
     * Get access token
     *
     * @return string
     */
    public function getRefreshToken();

    /**
     * Get access token
     *
     * @return string
     */
    public function getEndpoint();
}
