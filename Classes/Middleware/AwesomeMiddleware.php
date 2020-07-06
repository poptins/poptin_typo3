<?php
namespace PoptinLtd\PoptinSmartPopupsAndContactForms\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Http\JsonResponse;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Http\Response;
use TYPO3\CMS\Core\Http\Stream;
use TYPO3\CMS\Core\Database\ConnectionPool;


class AwesomeMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $handler->handle($request);
        $site_name = $GLOBALS['TYPO3_CONF_VARS']['SYS']['sitename'];
        $row = GeneralUtility::makeInstance(ConnectionPool::class)->getConnectionForTable('poptin')->select(
            [ 'POPTIN_CLIENT_ID'], // fields to select
            'poptin', // from
            [ 'account_id' => $site_name ] // where
        )->fetch();
        if (!isset($row) || empty($row)) {
            return $response;
        }
        $user_id = $row['POPTIN_CLIENT_ID'];
        $html = $response->getBody();
        $html = str_replace("</body>","<script id='pixel-script-poptin' src='https://cdn.popt.in/pixel.js?id=".$user_id."' async='true' type='text/javascript'></script></body>",$html);

        $body = new Stream('php://temp', 'wb+');
        
        $body->write($html);
        $response = $response->withBody($body);
    
        return $response;
    }
}