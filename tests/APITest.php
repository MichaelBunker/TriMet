<?php

declare(strict_types=1);

namespace TriMet\Tests;

use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use PHPUnit\Framework\MockObject\MockObject;
use TriMet\API;
use TriMet\Integration\TriMetException;
use TriMet\Integration\Wrapper;
use TriMet\Models\TriMetModel;
use TriMet\Serializer\DeSerializer;

final class APITest extends TriMetBaseTestCase
{
    protected API $class;
    protected DeSerializer $serializer;
    protected MockObject $wrapper;

    public function setUp(): void
    {
        $this->class      = new API("fakeApplicationID");
        $this->serializer = new DeSerializer();
        $this->wrapper    = $this->createMock(Wrapper::class);

        $this->setProtectedProperty($this->class, 'apiWrapper', $this->wrapper);
    }

    /**
     * @covers \TriMet\API::getArrivals
     */
    public function testExceptionForGetArrivals(): void
    {

        $this->expectException(TriMetException::class);
        $this->wrapper
            ->expects($this->once())
            ->method('get')
            ->with(
                'v2/arrivals',
                [
                    'locIDs'        => 1,
                    'showPosition'  => 'true',
                    'minutes'       => 1,
                    'arrivals'      => 1
                ]
            )
            ->willThrowException(new TriMetException());

        $this->class->getArrivals(1, 1, 1);
    }

    /**
     * @covers \TriMet\API::getArrivals
     */
    public function testGetArrivals(): void
    {
        $content    = Utils::streamFor('{"resultSet": "bar"}');
        $response   = new Response(200, [], $content);

        $this->wrapper
            ->expects($this->once())
            ->method('get')
            ->with(
                'v2/arrivals',
                [
                    'locIDs'        => 1,
                    'showPosition'  => 'true',
                    'minutes'       => 33,
                    'arrivals'      => 5
                ]
            )
            ->willReturn($response);

        $result = $this->class->getArrivals(1, 33, 5);

        $this->assertInstanceOf(TriMetModel::class, $result);
    }

    /**
     * @covers \TriMet\API::getArrivalsByDateRange
     */
    public function testGetArrivalsByDateRange(): void
    {
        $content    = Utils::streamFor('{"resultSet": "bar"}');
        $response   = new Response(200, [], $content);

        $this->wrapper
            ->expects($this->once())
            ->method('get')
            ->with(
                'v2/arrivals',
                [
                    'locIDs'        => 1,
                    'begin'         => 1600695649,
                    'end'           => 1600743882,
                    'showPosition'  => 'true',
                    'minutes'       => 33,
                    'arrivals'      => 5
                ]
            )
            ->willReturn($response);

        $result = $this->class->getArrivalsByDateRange(1, 1600695649, 1600743882, 33, 5);

        $this->assertInstanceOf(TriMetModel::class, $result);
    }

    /**
     * @covers \TriMet\API::getAlerts
     */
    public function testGetAlerts(): void
    {
        $content    = Utils::streamFor('{"resultSet": "bar"}');
        $response   = new Response(200, [], $content);

        $this->wrapper
            ->expects($this->once())
            ->method('get')
            ->with(
                'v2/alerts',
                [
                    'locIDs' => '99898',
                    'routes' => '38384'
                ]
            )
            ->willReturn($response);

        $result = $this->class->getAlerts([38384], [99898]);

        $this->assertInstanceOf(TriMetModel::class, $result);
    }

    /**
     * @covers \TriMet\API::getStops
     */
    public function testGetStops(): void
    {
        $content    = Utils::streamFor('{"resultSet": "bar"}');
        $response   = new Response(200, [], $content);

        $this->wrapper
            ->expects($this->once())
            ->method('get')
            ->with(
                'v1/stops',
                [
                    'll' => 98.1241 . ',' . 84.45453,
                    'feet' => 343432,
                    'showRouteDirs' => 'true'
                ]
            )
            ->willReturn($response);

        $result = $this->class->getStops(98.1241, 84.45453, 343432);

        $this->assertInstanceOf(TriMetModel::class, $result);
    }
}
