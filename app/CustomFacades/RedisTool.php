<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/9/26
 * Time: 23:40
 */

namespace App\CustomFacades;
use Illuminate\Support\Facades\Facade;

class RedisTool extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'redistool';
    }
}