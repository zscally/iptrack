<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Ip extends Model
{
    protected $table = 'ips';
    protected $fillable = ['user_id', 'ip_address'];

    /**
     * Creates an ip.
     * @param Ip $ip_data
     */
    public function createIps($ip_data)
    {
        $ips = $this->insert($ip_data);
        return $ips;
    }
}
