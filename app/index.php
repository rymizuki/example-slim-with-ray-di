<?php

use Example\AppModule;
use Example\Container;
use Example\Modules\Store\StoreInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$container = new Container(new AppModule());

AppFactory::setContainer($container);
$app = AppFactory::create();

$app->get('/', function (Request $req, Response $res, array $args) {
    $res->getBody()->write("Hello, slim");
    return $res;
});

$app->get('/posts/{id}', function (Request $req, Response $res, array $args) {
    $store = $this->get(StoreInterface::class);
    $id = $args['id'];
    $row = $store->get($id);
    if (!$row) {
        throw new HttpNotFoundException($req, "id($id) post notfound");
    }
    $payload = json_encode($row);
    $res->getBody()->write($payload);
    return $res->withHeader('Content-Type', 'application/json');
});

$app->post('/posts', function (Request $req, Response $res) {
    $body = $req->getParsedBody();
    $id = uniqid();
    $store = $this->get(StoreInterface::class);
    $store->set($id, [
        'id' => $id,
        'subject' => $body['subject'],
        'content' => $body['content'],
        'created_at' => (new \DateTime())->format(\DateTime::ATOM),
    ]);
    $payload = json_encode(['id' => $id]);
    $res->getBody()->write($payload);
    return $res->withHeader('Content-Type', 'application/json');
});

$app->run();