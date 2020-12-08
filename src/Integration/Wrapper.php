<?php

declare(strict_types = 1);

namespace TriMet\Integration;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * API Wrapper for TriMet API.
 */
class Wrapper implements IntegrationInterface
{
    const BASE_TRIMET_URL = 'http://developer.trimet.org/ws/';

    protected Client $client;
    protected string $applicationId;

    /**
     * TriMet wrapper constructor.
     *
     * @param string $applicationId
     * @param Client $client
     */
    public function __construct(string $applicationId, Client $client = null)
    {
        $this->client = $client ?? new Client([
            'base_uri' => self::BASE_TRIMET_URL,
            'timeout'  => 2.0
        ]);

        $this->applicationId = $applicationId;
    }

    /**
     * Get request.
     *
     * @param string                $resource
     * @param array                 $query
     * @param MessageInterface|null $body
     *
     * @throws TriMetException
     *
     * @return ResponseInterface
     */
    public function get(string $resource, array $query = [], MessageInterface $body = null): ResponseInterface
    {
        $request = $this->createRequest(HttpEnum::GET, $resource, $query);

        try {
            $response = $this->client->send($request);
        } catch (GuzzleException $e) {
            throw new TriMetException($e->getMessage(), $e->getCode());
        }

        $this->handleResponseErrors($response);

        return $response;
    }

    /**
     * Post request.
     *
     * @param string                $resource
     * @param MessageInterface|null $body
     *
     * @throws NotImplementedException Method is not implemented.
     *
     * @return ResponseInterface
     */
    public function post(string $resource, MessageInterface $body = null): ResponseInterface
    {
        throw new NotImplementedException(sprintf('%s method is not implemented', HttpEnum::POST));
    }

    /**
     * Put request.
     *
     * @param string                $resource
     * @param MessageInterface|null $body
     *
     * @throws NotImplementedException Method not implemented.
     *
     * @return ResponseInterface
     *
     */
    public function put(string $resource, MessageInterface $body = null): ResponseInterface
    {
        throw new NotImplementedException(sprintf('%s method is not implemented', HttpEnum::PUT));
    }

    /**
     * Delete request.
     *
     * @param string                $resource
     * @param MessageInterface|null $body
     *
     * @throws NotImplementedException Method not implemented.
     *
     * @return ResponseInterface
     *
     */
    public function delete(string $resource, MessageInterface $body = null): ResponseInterface
    {
        throw new NotImplementedException(sprintf('%s method is not implemented', HttpEnum::DELETE));
    }

    /**
     * Create request.
     *
     * Adding json formatting and application ID for every request.
     *
     * @param string $method
     * @param string $uri
     * @param array  $parameters
     *
     * @return RequestInterface
     */
    protected function createRequest(string $method, string $uri, $parameters = []): RequestInterface
    {
        $parameters = array_merge($parameters, ['json' => 'true', 'appId' => $this->applicationId]);
        $uri        = $uri . '?' . http_build_query($parameters);

        return new Request($method, $uri, []);
    }

    /**
     * Handle errors.
     *
     * @param ResponseInterface $response
     *
     * @throws TriMetException Errors returned from the TriMet API
     *
     * @return void
     *
     */
    protected function handleResponseErrors(ResponseInterface $response)
    {
        if ($response->getStatusCode() >= 300) {
            throw new TriMetException($response->getReasonPhrase() ?? "Something went wrong with the request.", $response->getStatusCode());
        }
    }
}
