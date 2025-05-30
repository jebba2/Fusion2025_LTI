<?php

declare(strict_types=1);

namespace GAState\MyLTIApp\Routes;

use Slim\Interfaces\RouteCollectorProxyInterface       as RouteContainer;
use GAState\MyLTIApp\Controller\SmartController;

class SmartWebRoutes
{
    /**
     * Load Routes Function
     *
     * @param RouteContainer $routes Route Container
     *
     * @return void
     */
    public static function loadRoutes(RouteContainer $routes): void
    {
         //Begin Smart Routes
        $routes->get(
            '/smartpost',
            [SmartController::class,
            'getRedirectPost']
        );

        $routes->get(
            '/smarttest',
            [SmartController::class,
            'smartTest']
        );
        //End Smart Routes
    }
}
