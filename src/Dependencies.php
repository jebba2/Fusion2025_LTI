<?php

declare(strict_types=1);

namespace GAState\MyLTIApp;

use GAState\MyLTIApp\App     as App;
use GAState\MyLTIApp\Env     as Env;
use GAState\Web\LTI\Slim\App as BaseApp;

// use GAState\Web\Slim\Cache\AppCacheFactoryInterface as AppCacheFactory;
// use GAState\Web\Slim\Cache\DBAppCacheFactory        as DBAppCacheFactory;
// use GAState\Web\Slim\Log\DBLoggerFactory            as DBLoggerFactory;
// use GAState\Web\Slim\Log\LoggerFactoryInterface     as LoggerFactory;

return (function () {
    /**
     * Default dependencies
     *
     * @var array<string,mixed> $defaultDeps
     */
    $defaultDeps = require(Env::getString(Env::LTI_DIR) . "/Dependencies.php");

    /**
     * Environment variables
     *
     * @var array<string,mixed> $envVars
     */
    $envVars = [
        // 'appCacheOptions' => [
        //     'db_table' => 'AppCache'
        // ],
        // 'logTable' => 'AppLog',
    ];

    /**
     * App dependencies
     *
     * @var array<string,mixed> $appDeps
     */
    $appDeps = [
        BaseApp::class => \DI\autowire(App::class),
    ];

    return array_merge($defaultDeps, $envVars, $appDeps);
})();
