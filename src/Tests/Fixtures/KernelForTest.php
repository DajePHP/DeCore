<?php

namespace Daje\HttpKernel\Tests\Fixtures;

use Daje\HttpKernel\Kernel;


class KernelForTest extends Kernel
{

    public function registerStack()
    {
    }

    public function isBooted()
    {
        return $this->booted;
    }
}
