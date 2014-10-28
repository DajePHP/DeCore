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

$RouterRule = new \Dice\Rule();
$RouterRule->substitutions['FastRoute\Dispatcher'] = new \Dice\Instance('FastRoute\Dispatcher\GroupCountBased');
$dice->addRule('DajePHP\RouterMiddleware\RouterMiddleware', $RouterRule);

$routing = $dice->create('DajePHP\RouterMiddleware\RouterMiddleware');

$response = $routing->handle(\Symfony\Component\HttpFoundation\Request::createFromGlobals());
$response->send();