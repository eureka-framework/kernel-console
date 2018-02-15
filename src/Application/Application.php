<?php

/*
 * Copyright (c) Romain Cottard
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eureka\Console\Kernel\Application;

use Eureka\Component\Config\Config;
use Eureka\Component\Http\Message as HttpMessage;
use Eureka\Component\Http\Middleware as HttpMiddleware;
use Eureka\Component\Psr\Http\Middleware;
use Psr\Container;

/**
 * Application class
 *
 * @author Romain Cottard
 */
class Application implements ApplicationInterface
{
    /** @var Middleware\MiddlewareInterface[] $middleware */
    protected $middleware = [];

    /** @var \Psr\Container\ContainerInterface $container */
    protected $container = null;

    /** @var \Eureka\Component\Config\Config $container */
    protected $config = null;

    /**
     * Application constructor.
     *
     * @param  \Psr\Container\ContainerInterface $container
     * @param  \Eureka\Component\Config\Config $config
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     */
    public function __construct(Container\ContainerInterface $container, Config $config)
    {
        $this->container = $container;
        $this->config    = $config;
    }

    /**
     * Run application based on the route.
     *
     * @return void
     */
    public function run()
    {
        //~ Default response
        $response = new HttpMessage\Response();

        try {
            $this->loadMiddleware();

            //~ Get response
            $stack    = new HttpMiddleware\Stack($response, $this->middleware);
            $response = $stack->process(HttpMessage\ServerRequest::createFromGlobal());

        } catch(Container\ContainerExceptionInterface $exception) {

            $body = '<h3>' . $exception->getMessage() . '</h3>';
            if (true === $this->config->get('kernel.debug')) {
                 $body .= '<pre>' . var_export($exception->getTraceAsString(), true) . '</pre>';
            }
            $response->getBody()->write($body);
        }

        //~ Send response
        (new HttpMessage\ResponseSender($response))->send();
    }

    /**
     * Load middleware
     *
     * @return void
     * @throws \Psr\Container\ContainerExceptionInterface
     */
    private function loadMiddleware()
    {
        $this->middleware = [];

        $list = $this->config->get('app.middleware');

        foreach ($list as $name => $conf) {
            $services = $conf['services'];
            foreach ($services as $service) {
                // todo
            }
            $this->middleware[] = new $conf['class']($this->container, $this->config);
        }
    }
}
