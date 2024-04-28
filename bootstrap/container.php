<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Psr\Http\Message\{
    ResponseFactoryInterface,
    UploadedFileFactoryInterface,
    StreamFactoryInterface,
    ServerRequestFactoryInterface
};
use Slim\Psr7\Factory\{
    ResponseFactory,
    ServerRequestFactory,
    StreamFactory,
    UploadedFileFactory
};

$containerBuilder = new ContainerBuilder();

$responseFactory = new ResponseFactory();
$serverRequestFactory = new ServerRequestFactory();
$streamFactory = new StreamFactory();
$uploadedFileFactory = new UploadedFileFactory();

$containerBuilder->addDefinitions([
    ResponseFactoryInterface::class => $responseFactory,
    ServerRequestFactoryInterface::class => $serverRequestFactory,
    StreamFactoryInterface::class => $streamFactory,
    UploadedFileFactoryInterface::class => $uploadedFileFactory,
]);

# Add here other container definitions.

return $containerBuilder->build();
