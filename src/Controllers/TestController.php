<?php

declare(strict_types=1);

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Swoole\Coroutine\Http\Client;

class TestController extends BaseController
{
    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function helloWorld(Request $request, Response $response): Response
    {
        return $this->jsonResponse(
            response: $response,
            body: [
                'message' => 'Hello world!'
            ]
        );
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function coroutineGetRequest(Request $request, Response $response): Response
    {
        $client = new Client("example.com", 443, true);
        $client->get("/");

        return $this->jsonResponse(
            response: $response,
            body: [
                "code" => $client->statusCode,
                "body" => $client->body
            ]
        );
    }
}
