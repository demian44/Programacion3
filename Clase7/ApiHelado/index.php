<?php

include "./AccesoDatos.php";
include "./cliente.php";

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';

$app = new \Slim\App;

$app->group('/saludo',function(){
    $this->get('/{nombre}',function($request,$response,$args){
        $nombre = $args['nombre'];
        $response->getBody()->write("Hola $nombre");
    });
});

$app->run();
?>