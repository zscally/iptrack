<?php

namespace App\Controllers;

use Illuminate\Support\Facades\DB;
use \Slim\Twig as view;

class HomeController extends Controller
{
    public $container, $tiny;
    public function __construct($container)
    {
        $this->container = $container;
        $this->tiny = $container->tiny;
    }

    /**
     * Home controller
     *
     * @param $request
     * @param $response
     * @param $args
     * @return mixed
     */
    public function index($request, $response, $args)
    {
        $args['page_title'] = 'Home';
        $messages = $this->flash->getMessages();
        if( ! empty( $messages ) ) {
            $args['messages'] = $messages;
        }
        return $this->view->render($response, 'home.html', $args);
    }
}
