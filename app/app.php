<?php

// Front controller

use Symfony\Component\HttpFoundation\Request;
use DajePHP\FastRouteMiddleware\FastRouteMiddleware;
use \Daje\HttpKernel\Env;
$loader = require_once __DIR__.'/../vendor/autoload.php';

require_once __DIR__.'/AppKernel.php';
require_once __DIR__.'/HelloController.php';

$dispatcher = \FastRoute\simpleDispatcher(function(\FastRoute\RouteCollector $r) {
        $r->addRoute('GET', '/hello/{name}', 'HelloController::get');
});

$app = new FastRouteMiddleware($dispatcher);

$kernel = new AppKernel($app, Env::Prod());

Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();

