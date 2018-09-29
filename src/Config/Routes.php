<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/usuarios', function (Request $request, Response $response) {
	$usersController = new App\Controllers\UsersController;
	$usersController->listar();
});