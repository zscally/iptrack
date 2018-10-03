<?php

namespace App\Controllers;


/**
 * @OA\Info(
 *     title="IP Track",
 *     version="1.0.0",
 *     @OA\Contact(
 *         email="contact@pastiebin.com"
 *     )
 * )
 */

class Controller
{
    public $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public function __get($property)
    {
        if( $this->container->{$property} )
        {
            return $this->container->{$property};
        }
    }
}
