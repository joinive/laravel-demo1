<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/9/18
 * Time: 21:22
 */


namespace App\Repositories\Eloquent;
use App\Repositories\Contracts\UserInterface;
use App\User;

//服务模式
class UserServiceRepository implements UserInterface{
    public function findBy($id)
    {
        return User::find($id);
    }
}