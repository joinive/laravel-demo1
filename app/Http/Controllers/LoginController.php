<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/9/2
 * Time: 22:47
 */

use Socialite;

class LoginController extends Controller
{
    /**
     * 将用户重定向到Github认证页面
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * 从Github获取用户信息.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();

        dd($user->token);
    }

}