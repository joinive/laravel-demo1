<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/9/2
 * Time: 22:04
 */

namespace App\Controllers;

use Illuminate\Http\Request;
use Cache;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller{

    /**
     * 测试rpc
     * @param $name
     * @return string
     */
    public function testRpc($name) {
        return 'update name: ' . $name;
    }

}