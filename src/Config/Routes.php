<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app->get('/usuarios', function (Request $request, Response $response) {
	$usersController = new App\Controllers\UsersController($request);

	return $response
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($usersController->all()));
});

$app->get('/usuarios/{id}', function (Request $request, Response $response) {
	$usersController = new App\Controllers\UsersController($request);

	return $response
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($usersController->get()));
});

$app->post('/usuarios', function (Request $request, Response $response) {
	$usersController = new App\Controllers\UsersController($request);

	return $response
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($usersController->add()));
});

$app->put('/usuarios/{id}', function (Request $request, Response $response) {
	$usersController = new App\Controllers\UsersController($request);

	return $response
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($usersController->edit()));
});

$app->delete('/usuarios/{id}', function (Request $request, Response $response) {
	$usersController = new App\Controllers\UsersController($request);

	return $response
		->withHeader('Content-Type', 'application/json')
		->write(json_encode($usersController->delete()));
});