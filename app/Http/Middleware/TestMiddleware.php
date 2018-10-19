<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class TestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $api_token = $request->header('api_token',null);
        $user_id = $request->get('user_id');
        $user = User::findOrfail($user_id);
        $remember_token = $user->remember_token ;
        //教研是否过期
        $created_at  = User::findOrfail($user_id)->created_at ;
        if (time() > strtotime($created_at) + 600) {
            //过期
            $user->remember_token = md5(time());
            $user->save();
        }

        if (!$api_token ||$api_token != 'aaa' ) {
            return response()->json(['error'=>'asdfsdfad']);
        }
        return $next($request);
    }
}
