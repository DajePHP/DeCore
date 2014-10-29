<?php

require_once '../vendor/autoload.php';

use Dice\Dice;

function handler($params) {
    return new \Symfony\Component\HttpFoundation\Response('Hello ' . $params['name']);
}

$dice = new Dice();

$dice->assign(FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/hello/{name}', 'handler');
}));

$routerRule = new \Dice\Rule();
$routerRule->substitutions['FastRoute\Dispatcher'] = new \Dice\Instance('FastRoute\Dispatcher\GroupCountBased');
$dice->addRule('DajePHP\FastRouteMiddleware\FastRouteMiddleware', $routerRule);

$routing = $dice->create('DajePHP\FastRouteMiddleware\FastRouteMiddleware');

$negotiationRule = new \Dice\Rule();
$negotiationRule->substitutions['Symfony\Component\HttpKernel\HttpKernelInterface'] = new \Dice\Instance('DajePHP\FastRouteMiddleware\FastRouteMiddleware');
$dice->addRule('Negotiation\Stack\Negotiation', $negotiationRule);

$negotiation = $dice->create('Negotiation\Stack\Negotiation');

$response = $negotiation->handle(\Symfony\Component\HttpFoundation\Request::createFromGlobals());
$response->send();