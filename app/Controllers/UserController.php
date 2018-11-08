<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/9/2
 * Time: 22:04
 */

namespace App\Http\Controllers;

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
    /**
     * 为指定用户显示属性
     *
     * @param  int  $id
     * @return Response
     */
    public function showProfile($id)
    {
        $user = Cache::get('user:'.$id);
        if (!$user) {
            Cache::add('user:'.$id, 'sw', 300);
            $user = 'sw';
        }
        return view('user.profile', ['user' => $user]);
    }

    /**
     * 显示指定用户的属性
     *
     * @param  Request  $request
     * @param  string|int  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        //$request->session()->put('username', 'aaa');
        //$request->session()->put('password', 'ccc');
        //echo session('password', 'bbbb');
        //request->session()->push('user.teams', 'developers');

        ///$value = $request->session()->get('key');
        //$data = $request->session()->all();

        //dd($data);
        //return ($data);
        //
        //$request->session()->flash('status', '登录Laravel学院成功!');
        //$request->session()->reflash();

        //echo 'ds';exit;
        //return route('users.show', User::find($id));

        //return (new User())->resolveRouteBinding($id);

        return $id;
        return User::findOrfail($id);

        $user  = User::where('id',$id)->get();
        return $user;
        return redirect('/');

    }
}