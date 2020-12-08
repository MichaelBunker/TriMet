<?php declare(strict_types=1);

namespace Tests\Integration;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use TriMet\Integration\NotImplementedException;
use TriMet\Integration\TriMetException;
use TriMet\Integration\Wrapper;

final class WrapperTest extends TestCase
{
    /**
     * @covers \TriMet\Integration\Wrapper::get
     * @covers \TriMet\Integration\Wrapper::handleResponseErrors
     * @covers \TriMet\Integration\Wrapper::createRequest
     * @covers \TriMet\Integration\Wrapper::__construct
     */
    public function testGet()
    {
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], 'Hello, World'),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $class = new Wrapper("foo", $client);
        $response = $class->get('/sites');

        $this->assertInstanceOf(ResponseInterface::class, $response);
    }

    public function ExceptionResponseCodeProvider()
    {
        return [
            [300],
            [400],
            [500],
        ];
    }
    /**
     * @param int $responseCode
     *
     * @dataProvider ExceptionResponseCodeProvider
     *
     * @covers \TriMet\Integration\Wrapper::get
     * @covers \TriMet\Integration\Wrapper::handleResponseErrors
     * @covers \TriMet\Integration\Wrapper::createRequest
     * @covers \TriMet\Integration\Wrapper::__construct
     */
    public function testGetException(int $responseCode)
    {
        $mock = new MockHandler([
            new Response($responseCode, ['X-Foo' => 'Bar'], 'Hello, World'),
        ]);

        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $class = new Wrapper("foo", $client);

        $this->expectException(TriMetException::class);
        $class->get('/sites');
    }

    /**
     * @covers \TriMet\Integration\Wrapper::delete
     * @covers \TriMet\Integration\Wrapper::__construct
     */
    public function testDelete()
    {
        $wrapper = new Wrapper("foo");
        $this->expectException(NotImplementedException::class);
        $wrapper->delete("/test");
    }

    /**
     * @covers \TriMet\Integration\Wrapper::put
     * @covers \TriMet\Integration\Wrapper::__construct
     */
    public function testPut()
    {
        $wrapper = new Wrapper("foo");
        $this->expectException(NotImplementedException::class);
        $wrapper->put("/test");
    }

    /**
     * @covers \TriMet\Integration\Wrapper::post
     * @covers \TriMet\Integration\Wrapper::__construct
     */
    public function testPost()
    {
        $wrapper = new Wrapper("foo");
        $this->expectException(NotImplementedException::class);
        $wrapper->post("/test");
    }
}
