<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use App\Events\OrderShipped;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:event {event_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $event_name = $this->argument('event_name');
        //echo $event_name;


        //dd(User::all()->first());

        //event(new OrderShipped(User::all()->first()));

        $class_name = "App\Events\\".$event_name;
        event(new $class_name(User::all()->first()));


    }
}
