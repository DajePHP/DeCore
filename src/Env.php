<?php

namespace Daje\HttpKernel;


class Env
{
    private $name;
    private $debug;

    public function __construct($name, $debug)
    {
        $this->name = $name;
        $this->debug = (bool) $debug;
    }

    public static function Prod($debug = false)
    {
        return new self('prod', $debug);
    }

    public static function Dev($debug = true)
    {
        return new self('dev', $debug);
    }

    public static function Test($debug = true)
    {
        return new self('test', $debug);
    }

    /**
     * @return mixed
     */
    public function isDebug()
    {
        return $this->debug;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
} 