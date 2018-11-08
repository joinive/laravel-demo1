<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/11/5
 * Time: 0:32
 */
namespace App\Helpers;

use Hprose\Http\Client;

class HproseClient {

    protected $client;

    public function __construct()
    {
        try {
            $urlList = explode(',',env('RPC_SERVERS'));
            $client = Client::create($urlList, false);
            $this->client = $client;
        } catch (\Exception $e) {
            throw new \Exception('rpc client create error', 500);
        }
    }

    public function __call($name, $arguments)
    {
        $request = app('request');
        $params = array_merge([$request->server(), $request->header()], $arguments);
        return call_user_func_array([$this->client, $name], $params);
    }

}