<?php

declare(strict_types = 1);

namespace TriMet;

use TriMet\Integration\Wrapper;
use TriMet\Models\TriMetModel;
use TriMet\Serializer\DeSerializer;

/**
 * Class API
 *
 * Entry point for all of the requests to the SDK. Handles building the requests and building the response.
 */
class API
{
    protected Wrapper $apiWrapper;
    protected DeSerializer $serializer;

    /**
     * API constructor.
     *
     * @param string $applicationId
     * @codeCoverageIgnore
     */
    public function __construct(string $applicationId)
    {
        $this->apiWrapper = new Wrapper($applicationId);
        $this->serializer = new DeSerializer();
    }

    /**
     * @param int $locationId
     * @param int $minutes
     * @param int $arrivals
     *
     * @throws Integration\TriMetException
     *
     * @return array|object
     *
     */
    public function getArrivals(int $locationId, int $minutes = 20, int $arrivals = 2): array|TriMetModel
    {
        $result = $this->apiWrapper->get(
            'v2/arrivals',
            [
                'locIDs'        => $locationId,
                'showPosition'  => 'true',
                'minutes'       => $minutes,
                'arrivals'      => $arrivals
            ]
        );
        $data = json_decode($result->getBody()?->getContents());
        $converted = $this->serializer->convert($data->resultSet);

        return $converted;
    }

    /**
     * @param array $routes
     * @param array $locationIds
     *
     * @throws Integration\TriMetException
     *
     * @return array|object
     *
     */
    public function getAlerts(array $routes = [], array $locationIds = [])
    {
        $params = [];

        if ($routes) {
            $params = array_merge($params, ['routes' => implode(',', $routes)]);
        }

        if ($locationIds) {
            $params = array_merge($params, ['locIDs' => implode(',', $locationIds)]);
        }

        $result = $this->apiWrapper->get('v2/alerts', $params);
        $data   = json_decode($result->getBody()?->getContents());

        return $this->serializer->convert($data->resultSet);
    }

    /**
     * Get Arrivals by a date range.
     *
     * @throws Integration\TriMetException
     *
     */
    public function getArrivalsByDateRange(int $locationId, int $begin, int $end = null, int $minutes = 20, int $arrivals = 2): array|object
    {
        $params = [
            'locIDs'        => $locationId,
            'begin'         => $begin,
            'showPosition'  => 'true',
            'minutes'       => $minutes,
            'arrivals'      => $arrivals
        ];

        if (isset($end)) {
            $params = array_merge($params, ['end' => $end]);
        }

        $result = $this->apiWrapper->get('v2/arrivals', $params);
        $data   = json_decode($result->getBody()?->getContents());

        return $this->serializer->convert($data->resultSet);
    }

    /**
     * Get the stops within x feet from a given longitude and latitude.
     *
     * @param float $longitude
     * @param float $latitude
     * @param int   $feet
     *
     * @throws Integration\TriMetException
     *
     * @return array|object
     *
     */
    public function getStops(float $longitude, float $latitude, int $feet = 1000): array|object
    {
        $result = $this->apiWrapper->get(
            'v1/stops',
            [
                'll'            => $longitude . ',' . $latitude,
                'feet'          => $feet,
                'showRouteDirs' => 'true'
            ]
        );
        $data = json_decode($result->getBody()?->getContents());

        return $this->serializer->convert($data->resultSet);
    }
}
