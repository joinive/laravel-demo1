<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Watson\Rememberable\Rememberable;

class Base extends Model
{
    //
    use Rememberable;

    public function scopeWithCertain($query, $relation, Array $columns) {
        return $query->with([$relation=> function($query) use($columns) {
            $query->select(array_merge(['id'], $columns));
        }]);
    }
}
