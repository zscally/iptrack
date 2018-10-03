<?php
use Respect\Validation\Validator as v;

//entry point setup a new game.
$app->get('/', 'HomeController:index')->setName('home');

$ip_payload_validator = v::arrayVal()->each(v::ip())->setName('ip_address');

$app->post('/api/ip/save', 'IpController:save')->setName('ip_address')
    ->add(new \DavidePastore\Slim\Validation\Validation(['ip_address' => $ip_payload_validator]));


/**
 * Swagger Documentation.
 */

$app->get('/v1/docs', 'ApiController:buildSwaggerDocs')->setName('Swagger Docs');