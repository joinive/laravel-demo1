<?php
/**
 * Created by PhpStorm.
 * User: Lenovo
 * Date: 2018/9/18
 * Time: 21:22
 */

namespace App\Repositories\Contracts;
interface UserInterface{
    public function findBy($id);
}