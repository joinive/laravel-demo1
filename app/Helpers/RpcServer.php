<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/11/5
 * Time: 0:12
 */

class RpcServer {

    private $obj;
    public function __construct(Object $obj)
    {
        $this->obj = $obj;
    }

    public function run() {
        $service  = new Yar_Server($this->obj);
        $service->handle();
    }
}