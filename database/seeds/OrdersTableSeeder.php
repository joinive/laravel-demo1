<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('orders')->delete();
        
        \DB::table('orders')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 1,
                'name' => 'sfs',
                'created_at' => '2018-09-30 22:55:58',
                'updated_at' => '2018-09-30 22:56:02',
            ),
        ));
        
        
    }
}