<?php

/*
 * Copyright (c) Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eureka\Kernel\Console\Application;

/**
 * Application interface
 *
 * @author Romain Cottard
 */
interface ApplicationInterface
{
    /**
     * Run Application
     *
     * @return void
     */
    public function run();

    /**
     * Code to execute before running the application
     *
     * @return void
     */
    public function before();

    /**
     * Code to execute after running the application.
     * @return void
     */
    public function after();

    /**
     * Terminate application.
     *
     * @return void
     */
    public function terminate();
}
