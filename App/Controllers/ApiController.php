<?php

namespace App\Controllers;

use Illuminate\Support\Facades\DB;
use OpenApi\Annotations\OpenApi;
use \Slim\Twig as view;

class ApiController extends Controller
{
    public $container;
    public function __construct($container)
    {
        $this->container = $container;
    }

    public function index($request, $response, $args)
    {

    }

    public function buildSwaggerDocs($request, $response, $args)
    {
        $dir = __DIR__ . '/../Controllers'; // Scan Controller folder
        $swagger = \OpenApi\scan($dir);
        return $response->withStatus(200)
            ->withHeader("Content-Type", "application/x-yaml")
            ->write($swagger->toYaml());

    }
}
