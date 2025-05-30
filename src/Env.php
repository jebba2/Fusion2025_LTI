<?php

declare(strict_types=1);

namespace GAState\MyLTIApp;

use GAState\Web\LTI\Slim\Env as BaseEnv;

class Env extends BaseEnv
{
    /**
     * @return void
     */
    protected static function setDefaults(): void
    {
        parent::setDefaults();
    }
}
