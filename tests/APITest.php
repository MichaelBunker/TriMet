<?php declare(strict_types=1);

use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use TriMet\API;
use TriMet\Integration\TriMetException;
use TriMet\Integration\Wrapper;
use TriMet\Models\TriMetModel;
use TriMet\Serializer\DeSerializer;
use function GuzzleHttp\Psr7\stream_for;

final class APITest extends TestCase
{
    protected $serializer;
    protected $wrapper;
    protected $class;

    public function setUp(): void
    {
        $this->serializer = $this->createMock(DeSerializer::class);
        $this->wrapper    = $this->createMock(Wrapper::class);
        $this->class      = $this->createPartialMock(API::class, ['getApi', 'getSerializer']);
        $this->class->expects($this->any())->method('getApi')->willReturn($this->wrapper);
        $this->class->expects($this->any())->method('getSerializer')->willReturn($this->serializer);
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
        $this->serializer
            ->expects($this->never())
            ->method('convert');

        $this->class->getArrivals(1, 1, 1);
    }

    /**
     * @covers \TriMet\API::getArrivals
     */
    public function testGetArrivals(): void
    {
        $content    = stream_for('{"resultSet": "bar"}');
        $response   = new Response(200, [], $content);
        $model      = new TriMetModel();

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
        $this->serializer
            ->expects($this->once())
            ->method('convert')
            ->with("bar")
            ->willReturn($model);

        $result = $this->class->getArrivals(1, 33, 5);

        $this->assertEquals($model, $result);
    }

    /**
     * @covers \TriMet\API::getArrivalsByDateRange
     */
    public function testGetArrivalsByDateRange(): void
    {
        $content    = stream_for('{"resultSet": "bar"}');
        $response   = new Response(200, [], $content);
        $model      = new TriMetModel();

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
        $this->serializer
            ->expects($this->once())
            ->method('convert')
            ->with("bar")
            ->willReturn($model);

        $result = $this->class->getArrivalsByDateRange(1, 1600695649, 1600743882, 33, 5);

        $this->assertEquals($model, $result);
    }

    /**
     * @covers \TriMet\API::getAlerts
     */
    public function testGetAlerts(): void
    {
        $content    = stream_for('{"resultSet": "bar"}');
        $response   = new Response(200, [], $content);
        $model      = new TriMetModel();

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
        $this->serializer
            ->expects($this->once())
            ->method('convert')
            ->with("bar")
            ->willReturn($model);

        $result = $this->class->getAlerts([38384], [99898]);

        $this->assertEquals($model, $result);
    }

    /**
     * @covers \TriMet\API::getStops
     */
    public function testGetStops(): void
    {
        $content    = stream_for('{"resultSet": "bar"}');
        $response   = new Response(200, [], $content);
        $model      = new TriMetModel();

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
        $this->serializer
            ->expects($this->once())
            ->method('convert')
            ->with("bar")
            ->willReturn($model);

        $result = $this->class->getStops(98.1241, 84.45453, 343432);

        $this->assertEquals($model, $result);
    }


}
