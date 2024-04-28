<?php

declare(strict_types=1);

use Slim\Factory\AppFactory;
use Swoole\Http\Server;
use Chubbyphp\SwooleRequestHandler\OnRequest;
use Chubbyphp\SwooleRequestHandler\PsrRequestFactory;
use Chubbyphp\SwooleRequestHandler\SwooleResponseEmitter;

require_once __DIR__ . "/vendor/autoload.php";

/**@var \Psr\Container\ContainerInterface */
$container = require __DIR__ . "/bootstrap/container.php";

/**@var callable */
$routes = require __DIR__ . "/routes/api.php";

$app = AppFactory::createFromContainer($container);
$routes($app);

$server = new Server('0.0.0.0', 8000);
$server->set([
    // The number of worker processes to start, in our case all workers will handle http requests
    'worker_num' => 12,
]);
Swoole\Runtime::enableCoroutine($flags = SWOOLE_HOOK_ALL);
$server->on('request', function ($request, $response) use ($app) {
    (new OnRequest(
        $app->getContainer()->get(PsrRequestFactory::class),
        new SwooleResponseEmitter(),
        $app
    ))->__invoke($request, $response);
});

$server->start();
