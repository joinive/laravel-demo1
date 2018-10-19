<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect([
            ['adf'=>'adfasdf','adfaaa'=>'adf'],
            ['adf232'=>'adfasdf','adfbbb'=>'adfasdf']
        ]);
        //return User::all();
    }
}
