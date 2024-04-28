<?php

declare(strict_types=1);

use App\Controllers\TestController;
use Slim\App;

#Application routes
return function (App $app): void {
    $app->get("/hello", [TestController::class, "helloWorld"]);
    $app->get("/get-coroutine", [TestController::class, "coroutineGetRequest"]);
};
