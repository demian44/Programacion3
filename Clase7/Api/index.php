<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';

$app = new \Slim\App;
// $app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
//     $name = $args['name'];
//     $response->getBody()->write("Hello, $name");

//     return $response;
// });

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
     $name = $args['name'];
     $response->getBody()->write("Hello $name");
    //$response->getBody()->write("Hello world");
    return $response;
});

$app->post('/hello', function (Request $request, Response $response, array $args) {
    //$name =  $request["name"];
    $parsedBody = $request->getParsedBody();
    $name = $parsedBody['name'];
    //$name = $args['name'];
    $response->getBody()->write("Hello $name");
    return $response;
});

$app->post('/chao', function (Request $request, Response $response) {
    $body = $request->getParsedBody();
    
    $newResponse = $response->withJson($body,200);
    return $newResponse;
});

$app->run();
?>




