<?php

declare(strict_types=1);

use DI\ContainerBuilder      as DIContainerBuilder;
use GAState\MyLTIApp\Env     as Env;
use GAState\Web\LTI\Slim\App as BaseApp;


require '../vendor/autoload.php';


/**
     * Environment variables
     *
     * @var array<string,mixed> $envDeps
     */
    $envDeps = [
        'launchPrefix' => Env::getString(Env::LTI_LAUNCH_PREFIX),
        'statePrefix' => Env::getString(Env::LTI_STATE_PREFIX),
        'noncePrefix' => Env::getString(Env::LTI_NONCE_PREFIX),
        'issuer' => Env::getString(Env::LTI_ISSUER),
        'clientID' => Env::getString(Env::LTI_CLIENT_ID),
        'deploymentID' => Env::getString(Env::LTI_DEPLOYMENT_ID),
        'toolLaunchURL' => Env::getString(Env::LTI_LAUNCH_URL),
        'jwksCacheName' => Env::getString(Env::JWKS_CACHE_NAME),
        'jwksExpiresAfter' => Env::getInt(Env::JWKS_EXPIRES_AFTER),
        'jwksRegenKeyAt' => Env::getInt(Env::JWKS_REGEN_KEY_AT),
        'lmsKeySetURL' => Env::getString(Env::LMS_KEYSET_URL),
        'lmsLoginURL' => Env::getString(Env::LMS_LOGIN_URL),
    ]; 

    print_r($envDeps);
