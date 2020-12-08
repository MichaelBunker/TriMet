<?php

declare(strict_types = 1);

namespace TriMet\Integration;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Integration Interface
 */
interface IntegrationInterface
{
    /**
     * GET request.
     *
     * @param string                $resource
     * @param array                 $query
     * @param MessageInterface|null $body
     *
     * @return ResponseInterface
     */
    public function get(string $resource, array $query = [], MessageInterface $body = null): ResponseInterface;

    /**
     * POST request.
     *
     * @param string                $resource
     * @param MessageInterface|null $body
     *
     * @return ResponseInterface
     */
    public function post(string $resource, MessageInterface $body = null): ResponseInterface;

    /**
     * PUT request.
     *
     * @param string                $resource
     * @param MessageInterface|null $body
     *
     * @return ResponseInterface
     */
    public function put(string $resource, MessageInterface $body = null): ResponseInterface;

    /**
     * DELETE request.
     *
     * @param string                $resource
     * @param MessageInterface|null $body
     *
     * @return ResponseInterface
     */
    public function delete(string $resource, MessageInterface $body = null): ResponseInterface;
}
