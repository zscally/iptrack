<?php
use Respect\Validation\Validator as v;

//entry point setup a new game.
$app->get('/', 'HomeController:index')->setName('home');

$app->post('/ip/save', 'IpController:save')->setName('ip');