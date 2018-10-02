<?php

namespace App\Controllers;

use Illuminate\Support\Facades\DB;
use \App\Models\Ip;

class IpController extends Controller
{
    public $container;

    private $ip;

    public function __construct($container)
    {
        $this->container = $container;
        $this->ip = new \App\Models\Ip();
    }

    public function save($request, $response, $args)
    {
        $ips = $request->getParsedBody();
        $res = [];
        array_walk_recursive($ips, function($ip) use (&$res) {
            $res[] = [
                'ip_address'=>$ip,
                'user_id'=>$this->applyUserId()
            ];
        });

        $this->ip->createIps($res);

        return $response->withStatus(200)
            ->withHeader("Content-Type", "application/json")
            ->write(json_encode($res));

    }


    private function applyUserId()
    {
        return ( isset($_SESSION['user_id']) && ! empty($_SESSION['user_id']) ? $_SESSION['user_id'] : rand(0, 100));
    }
}
