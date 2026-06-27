<?php
declare(strict_types=1);

use App\Core\{Router, Request, Session, View};
use App\Exceptions\{EntityNotFoundException, AuthorizationException, AuthenticationException};

define('ROOT', dirname(__DIR__));

require ROOT . '/app/autoload.php';
require ROOT . '/app/Helpers/functions.php';

$config = require ROOT . '/config/config.php';
date_default_timezone_set($config['app']['timezone']);

Session::start();
View::setPath(ROOT . '/app/Views');

$router = new Router();
require ROOT . '/routes/web.php';

$request = new Request();

try {
    $router->dispatch($request)->send();

} catch (AuthenticationException $e) {
    Session::flash('error', $e->getMessage());
    (new \App\Core\Response('', 302, ['Location' => url('login')]))->send();

} catch (AuthorizationException $e) {
    http_response_code(403);
    echo View::render('errors/403', ['title' => 'Accès refusé', 'message' => $e->getMessage()]);

} catch (EntityNotFoundException $e) {
    http_response_code(404);
    echo View::render('errors/404', ['title' => 'Introuvable', 'message' => $e->getMessage()]);

} catch (\Throwable $e) {
    http_response_code(500);
    if (($config['app']['env'] ?? 'prod') === 'dev') {
        echo '<pre style="padding:20px;color:#b91c1c">' . e($e->getMessage()) . "\n" . e($e->getFile()) . ':' . $e->getLine() . '</pre>';
    } else {
        echo View::render('errors/500', ['title' => 'Erreur serveur']);
    }
}