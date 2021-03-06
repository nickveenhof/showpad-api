<?php
/**
 * This file was inherited and adapted from the turanct/showpad-api library
 */

namespace Showpad;

/**
 * Basic Client
 */
class Client
{
    /**
     * @var Authentication The authentication object
     */
    protected $auth;

    /**
     * Construct
     *
     * @param Authentication $auth The authentication object
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Get a list of existing assets
     *
     * GET /assets.json
     *
     * @param int $limit  The max number of items we want to retrieve
     * @param int $offset The number of items to skip from the top of the list
     *
     * @return array
     */
    public function assetsList($limit = 25, $offset = 0)
    {
        return $this->auth->request(
            'GET',
            '/assets.json',
            array('query' => array('limit' => (int) $limit, 'offset' => (int) $offset))
        );
    }

    /**
     * Add an asset
     *
     * POST /assets.json
     *
     * @param string $file The path to the file
     * @param string $uuid The UUID of the file as used in the source application
     *
     * @return array
     */
    public function assetsAdd($file, $uuid = '')
    {
        $resource = '/assets.json';

        $parameters = array(
            'multipart' => [
                [
                    'name'     => 'file',
                    'contents' => fopen($file, 'r')
                ],
                [
                    'name'     => 'externalId',
                    'contents' => $uuid
                ]
            ]
        );

        // Create request
        $data = $this->auth->request(
            'POST',
            $resource,
            $parameters
        );

        return $data;
    }

    /**
     * Get an asset by id
     *
     * GET /assets/{id}.json
     *
     * @param string $id The asset id
     *
     * @return array
     */
    public function assetsGet($id)
    {
        $resource = '/assets/' . $id . '.json';

        // Create request
        $data = $this->auth->request('GET', $resource);

        return $data;
    }

    /**
     * Delete asset by id
     *
     * DELETE /assets/{id}.json
     *
     * @param string $id The asset id
     *
     * @return array
     */
    public function assetsDelete($id)
    {
        $resource = '/assets/' . $id . '.json';

        // Create request
        $data = $this->auth->request('DELETE', $resource);

        return $data;
    }

    /**
     * Add a tag to an asset by tag name
     *
     * POST /assets/{id}/tags.json
     *
     * @param string $id  The asset id
     * @param string $tag The tag name
     *
     * @return array
     */
    public function assetsTagsAdd($id, $tag, $uuid = '')
    {
        $resource = '/assets/' . $id . '/tags.json';

        $parameters = array(
            'form_params' => array(
              'name' => $tag,
              'externalId' => $uuid,
            )
        );

        // Create request
        $data = $this->auth->request(
            'POST',
            $resource,
            $parameters
        );

        return $data;
    }

    /**
     * Add a tag to an asset by tag id
     *
     * POST /assets/{id}/tags.json
     *
     * @param string $id  The asset id
     * @param string $tag The tag id
     *
     * @return array
     */
    public function assetsTagsAddById($id, $tag)
    {
        $resource = '/assets/' . $id . '/tags/' . $tag . '.json';

        // Create request
        $data = $this->auth->request('LINK', $resource);

        return $data;
    }

    /**
     * Delete a tag from an asset by tag id
     *
     * UNLINK /assets/{id}/tags.json
     *
     * @param string $id  The asset id
     * @param string $tag The tag id
     *
     * @return array
     */
    public function assetsTagsRemoveById($id, $tag)
    {
        return $this->auth->request(
            'UNLINK',
            '/assets/' . $id . '/tags/' . $tag . '.json'
        );
    }

    /**
     * Get a list of existing assets
     *
     * GET /assets/{id}/tags.json
     *
     * @param int $assetId The id of the asset
     * @param int $limit  The max number of items we want to retrieve
     * @param int $offset The number of items to skip from the top of the list
     *
     * @return array
     */
    public function assetsTagsList($assetId, $limit = 25, $offset = 0)
    {
        return $this->auth->request(
            'GET',
            '/assets/' . $assetId . '/tags.json',
            array('query' => array('limit' => (int) $limit, 'offset' => (int) $offset))
        );
    }

    /**
     * Get a list of existing tags
     *
     * GET /tags.json
     *
     * @param int $limit  The max number of items we want to retrieve
     * @param int $offset The number of items to skip from the top of the list
     *
     * @return array
     */
    public function tagsList($limit = 25, $offset = 0)
    {
        $resource = '/tags.json';

        // Create request
        $data = $this->auth->request(
            'GET',
            $resource,
            array('query' => array('limit' => (int) $limit, 'offset' => (int) $offset))
        );

        return $data;
    }

    /**
     * Add a tag
     *
     * POST /tags.json
     *
     * @param string $name The tag name
     *
     * @return array
     */
    public function tagAdd($name)
    {
        $parameters = array(
            'form_params' => array(
              'name' => $name,
            )
        );

        $response = $this->auth->request(
            'POST',
            '/tags.json',
            $parameters
        );

        return $response;
    }

    /**
     * Get a list of assets coupled to a certain tag
     *
     * GET /tags/{id}/assets.json
     *
     * @param int $limit  The max number of items we want to retrieve
     * @param int $offset The number of items to skip from the top of the list
     *
     * @return array
     */
    public function tagAssetsList($tagId, $limit = 25, $offset = 0)
    {
        return $this->auth->request(
            'GET',
            '/tags/' . $tagId . '/assets.json',
            array('query' => array('limit' => (int) $limit, 'offset' => (int) $offset))
        );
    }
}
