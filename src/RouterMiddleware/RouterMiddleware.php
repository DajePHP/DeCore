<?php

namespace DajePHP\RouterMiddleware;

use FastRoute\Dispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class RouterMiddleware implements HttpKernelInterface
{
    private $dispatcher;

    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        $routeInfo = $this->dispatcher->dispatch($request->getMethod(), $request->getRequestUri());
        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                return new Response('Not found.', 404);
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                return new Response('Method not allowed.', 405);
                break;
            case Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                return call_user_func($handler, $vars);
                break;
        }

        return new Response('Unexpected Error', 500);
    }
} 