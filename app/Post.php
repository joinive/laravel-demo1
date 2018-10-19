<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Base
{
    //

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function test(){
        return self::where('id', 2)->withCertain('user', ['username'])->get();
    }
}
