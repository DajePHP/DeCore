<?php

namespace Daje\HttpKernel;

use Symfony\Component\HttpKernel\HttpKernelInterface;

/**
 * The Kernel is the heart of the Daje system.
 *
 * @api
 */
interface KernelInterface extends HttpKernelInterface, \Serializable
{
    /**
     * Returns an array of bundles to register.
     *
     * @return A
     *
     * @api
     */
    public function registerStack();

    /**
     * Returns an array of bundles to register.
     *
     * @return @todo
     *
     * @api
     */
    public function pushMiddleware();

    /**
     * Returns an array of bundles to register.
     *
     * @return @todo
     *
     * @api
     */
    public function resolveStack();

    /**
     * Boots the current kernel.
     *
     * @api
     */
    public function boot();

    /**
     * Shutdowns the kernel.
     *
     * This method is mainly useful when doing functional testing.
     *
     * @api
     */
    public function shutdown();

    /**
     * Gets the environment.
     *
     * @return string The current environment
     *
     * @api
     */
    public function getEnvironment();

    /**
     * Checks if debug mode is enabled.
     *
     * @return bool    true if debug mode is enabled, false otherwise
     *
     * @api
     */
    public function isDebug();

    /**
     * Gets the application root dir.
     *
     * @return string The application root dir
     *
     * @api
     */
    public function getRootDir();

    /**
     * Gets the request start time (not available if debug is disabled).
     *
     * @return int     The request start timestamp
     *
     * @api
     */
    public function getStartTime();

    /**
     * Gets the cache directory.
     *
     * @return string The cache directory
     *
     * @api
     */
    public function getCacheDir();

    /**
     * Gets the log directory.
     *
     * @return string The log directory
     *
     * @api
     */
    public function getLogDir();

    /**
     * Gets the charset of the application.
     *
     * @return string The charset
     *
     * @api
     */
    public function getCharset();
}
