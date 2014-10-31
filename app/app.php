<?php

// Front controller

use Symfony\Component\HttpFoundation\Request;

$loader = require_once __DIR__.'/../vendor/autoload.php';

require_once __DIR__.'/AppKernel.php';
require_once __DIR__.'/HelloController.php';

$kernel = new AppKernel('prod', false);

Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();

