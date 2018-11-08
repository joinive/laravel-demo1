<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/11/5
 * Time: 0:28
 */

namespace App\Helpers;

use Hprose\Http\Server;

class HproseServer {

    public function init()
    {
        $server = new Server();
        //定义需要远程调用的控制器并设置其别名
        $classes = [
            [new HomeController(),'home']
        ];

        //中间件
        $requestHandler = function ($name, array &$args, \stdClass $context, \Closure $next) {
            //模拟request
            $request = new Request();
            $request->server->add($args[0]);
            $request->headers->add($args[1]);
            $request->replace($args[2]);
            //重置参数
            $params = [$request];
            for ($i = 3; $i < count($args); $i++) {
                $params[] = $args[$i];
            }
            $result = $next($name, $params, $context);
            return $result;
        };
        foreach ($classes as $item) {
            if (is_array($item)) {
                $class = $item[0];
                $alias = $item[1];
            } else {
                $class = $item;
                $aliasExplode = explode('\\', get_class($item));
                $alias = $aliasExplode[count($aliasExplode) - 1];
            }

            $server->addInstanceMethods($class, '', $alias);

        }
        $server->addInvokeHandler($requestHandler);
        $server->start();
    }

}