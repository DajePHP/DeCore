<?php

namespace Daje\HttpKernel;

use Stack\Builder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Stack\Builder as StackBuilder;

abstract class Kernel implements KernelInterface, HttpKernelInterface
{
    protected $stackBuilder;
    protected $rootDir;
    protected $environment;
    protected $booted = false;
    protected $kernel;
    protected $startTime;

    /**
     * Constructor.
     *
     * @param HttpKernelInterface $app
     * @param Env $environment
     *
     * @api
     */
    public function __construct(HttpKernelInterface $app, Env $environment)
    {
        $this->environment = $environment;
        $this->rootDir = $this->getRootDir();
        $this->name = $this->getName();
        $this->stackBuilder = new StackBuilder();

        if ($this->isDebug()) {
            $this->startTime = microtime(true);
        }
    }


    public function __clone()
    {
        if ($this->isDebug()) {
            $this->startTime = microtime(true);
        }

        $this->booted = false;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     */
    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        if (false === $this->booted) {
            $this->boot();
        }

        return $this->kernel->handle($request, $type, $catch);
    }

    public function serialize()
    {
       // @todo
        //return serialize(array($this->environment, $this->debug));
    }

    public function unserialize($data)
    {
        // @todo
        //list($app, $environment, $debug) = unserialize($data);
        //$this->__construct($app, $environment, $debug);
    }

    /**
     * Returns an array of bundles to register.
     *
     * @return Builder
     *
     * @api
     */
    abstract public function registerStack();

    /**
     * Boots the current kernel.
     *
     * @api
     */
    public function boot()
    {
        $this->booted = true;
        $this->kernel = $this->resolveStack();
    }

    /**
     * Shutdowns the kernel.
     *
     * This method is mainly useful when doing functional testing.
     *
     * @api
     */
    public function shutdown()
    {
    }

    /**
     * {@inheritdoc}
     *
     * @api
     */
    public function pushMiddleware(/*$kernelClass, $args...*/)
    {
        if ($this->booted) {
            throw \Exception('TODO exception, impossible push a middleware now.');
        }
        $this->stackBuilder->push(func_get_args());

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     */
    public function resolveStack()
    {
        return $this->stackBuilder->resolve($this->app);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     */
    public function getName()
    {
        if (null === $this->name) {
            $this->name = preg_replace('/[^a-zA-Z0-9_]+/', '', basename($this->rootDir));
        }

        return $this->name;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     */
    public function isDebug()
    {
        return $this->environment->isDebug();
    }

    /**
     * {@inheritdoc}
     *
     * @api
     */
    public function getRootDir()
    {
        if (null === $this->rootDir) {
            $r = new \ReflectionObject($this);
            $this->rootDir = str_replace('\\', '/', dirname($r->getFileName()));
        }

        return $this->rootDir;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     */
    public function getStartTime()
    {
        return $this->isDebug() ? $this->startTime : -INF;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     */
    public function getCacheDir()
    {
        return $this->rootDir.'/cache/'.$this->environment;
    }

    /**
     * {@inheritdoc}
     *
     * @api
     */
    public function getLogDir()
    {
        return $this->rootDir.'/logs';
    }

    /**
     * {@inheritdoc}
     *
     * @api
     */
    public function getCharset()
    {
        return 'UTF-8';
    }
} 