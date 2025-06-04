<?php

declare(strict_types=1);
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 300');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');

use DI\ContainerBuilder      as DIContainerBuilder;
use GAState\MyLTIApp\Env     as Env;
use GAState\Web\LTI\Slim\App as BaseApp;

(function (mixed $baseDir, mixed $baseURI) {
    $baseDir = "/data/www/fusion2025";
    $baseURI = dirname($baseURI);
    /** @var Throwable|null $exception */
    $exception = null;

    register_shutdown_function(function () use (&$exception) {
        if ($exception !== null) {
            while (ob_get_level() > 0) {
                if (!ob_end_clean()) {
                    break;
                }
            }

            header("Content-Type: text/plain");
            echo "A fatal error has occurred. Please check the server for details.\n";

            do {
                echo sprintf(
                    "[%s] %s: %s - %s\n",
                    date('c'),
                    get_class($exception),
                    $exception->getMessage(),
                    json_encode($exception->getTrace()),
                );
                $exception = $exception->getPrevious();
            } while ($exception !== null);
        }
    });

    set_error_handler(function (int $errno, string $errstr, string $errfile, int $errline) {
        // error was suppressed with the @-operator
        if (0 === error_reporting()) {
            return false;
        }

        throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    });

    try {
        if (!ob_start()) {
            throw new RuntimeException('Unable to start output buffer');
        }

        if (!is_string($baseDir)) {
            throw new RuntimeException('Invalid base directory');
        }

        require $baseDir . '/vendor/autoload.php';

        Env::load($baseDir, $baseURI);

        $containerBuilder = (new DIContainerBuilder())
            ->useAttributes(true)
            ->addDefinitions(Env::getString(Env::DI_DEF_FILE));

        if (Env::getBool(Env::DI_ENABLE_CMPL)) {
            $containerBuilder = $containerBuilder
                ->enableCompilation(Env::getString(Env::DI_CMPL_DIR))
                ->writeProxiesToFile(true, Env::getString(Env::DI_PRXY_DIR));
        }

        $container = $containerBuilder->build();

        $app = $container->get(BaseApp::class);
        if (!$app instanceof BaseApp) {
            throw new RuntimeException("\$app is not an instance of " . BaseApp::class);
        }

        $app->init();

        while (ob_get_level() > 0) {
            if (!ob_end_clean()) {
                throw new RuntimeException('Unable to stop output buffer');
            }
        }
    } catch (Throwable $t) {
        $exception = $t;
        exit;
    }

    $app->run();
})($_ENV['BASE_DIR'] ?? null, $_SERVER['SCRIPT_NAME'] ?? '');
