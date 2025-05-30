<?php

/**
 * LTI Route Package
 *
 */

declare(strict_types=1);

namespace GAState\MyLTIApp;

use GAState\Web\LTI\Slim\App                     as LTIApp;
use Psr\Http\Server\MiddlewareInterface          as Middleware;
use Slim\Interfaces\RouteCollectorProxyInterface as RouteContainer;
use GAState\MyLTIApp\Routes\SmartWebRoutes;

/**
 * SLIM App Class
 *
 */

class App extends LTIApp
{
    /**
     * Load Middle Ware for Slim
     *
     * @param array<string,Middleware|null> $middleware Middle Ware
     *
     * @return void
     */
    protected function loadMiddleware(array $middleware): void
    {
        parent::loadMiddleware($middleware);
    }


    /**
     * Map Routes to Controllers For Slim
     *
     * @param RouteContainer $routes Route Container
     *
     * @return void
     */
    protected function loadRoutes(RouteContainer $routes): void
    {
        parent::loadRoutes($routes);
        SmartWebRoutes::loadRoutes($routes);
    }
}
