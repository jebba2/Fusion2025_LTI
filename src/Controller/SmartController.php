<?php

/**
 * Smart LTI Package
 * Creates SMART LTI Routes
 *
*/

declare(strict_types=1);

namespace GAState\MyLTIApp\Controller;

use GAState\Web\LTI\Action\LaunchAction           as LaunchAction;
use GAState\Web\LTI\Model\Message;
use Psr\Cache\CacheItemPoolInterface              as Cache;
use Psr\Http\Message\ServerRequestInterface       as Request;
use Psr\Http\Message\ResponseInterface            as Response;

class SmartController
{
    protected string $baseURI;
    protected readonly LaunchAction $action;
    protected readonly Cache $appCache;

    /**
     * Constructor Function
     *
     * @param LaunchAction $action       LTI Action
     * @param Cache        $appCache     LTI App Cache
     */
    public function __construct(
        LaunchAction $action,
        Cache $appCache
    ) {
        $this->action = $action;
        $this->appCache = $appCache;
    }

    /**
     * Smart Redirect to POST Webpage
     *
     * @param Request  $request  Request
     * @param Response $response Response
     *
     * @return Response
     */
    public function getRedirectPost(
        Request $request,
        Response $response
    ): Response {

        $cookies = $request->getCookieParams();
        $launchID = strval($cookies["lti-1_3-launch"] ?? '');
        $message = $this->appCache->getItem("lti-1_3-{$launchID}")->get();

        if ($message instanceof Message) {
            ob_start();
            include __DIR__ . '/../assets/smart/redirectpost.php';

            $output = ob_get_contents();

            ob_end_clean();

            if ($output != false) {
                $response->getBody()->write($output);
            }

            return $response;
        } else {
            ob_start();
            include __DIR__ . '/../assets/NotLogin.html';

            $output = ob_get_contents();

            ob_end_clean();

            if ($output != false) {
                $response->getBody()->write($output);
            }

            return $response;
        }
    }

    /**
     * @param Request $request
     * @param Response $response
     *
     * @return Response
     */
    public function smartTest(
        Request $request,
        Response $response
    ): Response {

        $cookies = $request->getCookieParams();
        $launchID = strval($cookies["lti-1_3-launch"] ?? '');
        $message = $this->appCache->getItem("lti-1_3-{$launchID}")->get();

        if ($message instanceof Message) {
            ob_start();
            include __DIR__ . '/../assets/smart/smarttest.php';

            $output = ob_get_contents();

            ob_end_clean();

            if ($output != false) {
                $response->getBody()->write($output);
            }
            return $response;
        } else {
            ob_start();
            include __DIR__ . '/../assets/NotLogin.html';

            $output = ob_get_contents();

            ob_end_clean();

            if ($output != false) {
                $response->getBody()->write($output);
            }

            return $response;
        }
    }
}
