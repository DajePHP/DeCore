<?php

use Daje\HttpKernel\Kernel;

class AppKernel extends Kernel
{
    public function registerStack()
    {
        $this
            ->pushMiddleware('Symfony\Component\HttpKernel\HttpCache\HttpCache', new \Symfony\Component\HttpKernel\HttpCache\Store(__DIR__.'/cache'))
            ->pushMiddleware('Negotiation\Stack\Negotiation');
    }
}

