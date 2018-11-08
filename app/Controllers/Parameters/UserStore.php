<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/11/5
 * Time: 1:02
 */
namespace App\Controllers\Parameters;

use Zhuqipeng\LaravelHprose\Parameters\Base;

class UserStore extends Base
{
    public function rules()
    {
        return [
            'name'  => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute 参数是必传的'
        ];
    }

    public function formatErrors(\Illuminate\Support\MessageBag $errorMessage)
    {
        return [
            'status_code'   => 400,
            'message'       => $errorMessage->first(),
        ];
    }
}
