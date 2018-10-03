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

    /**
     * @OA\Post(
     *     path="/ip/save",
     *     @OA\Response(
     *          response="200",
     *          description="Successfully added IP(s) to the database for processing..."
     *     ),
     *     @OA\Response(
     *          response="400",
     *          description="Unable to add IP(s) to the database for processing..."
     *     )
     * )
     */
    public function save($request, $response, $args)
    {
        if( $request->getAttribute('has_errors') )
        {
            $body = json_encode([
                'status' => 'error',
                'messages' =>  $request->getAttribute('errors'),
                'post_body' => $request->getParsedBody()
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            return $response->withStatus(200)
                ->withHeader("Content-Type", "application/json")
                ->write($body);
        }


        $ips = $request->getParsedBody();
        $res = [];
        array_walk_recursive($ips, function($ip) use (&$res) {
            $res[] = [
                'ip_address'=>$ip,
                'user_id'=>$this->applyUserId(),
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=> date('Y-m-d H:i:s')
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
