<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Kafka\Producer;
use Kafka\ProducerConfig;
use Monolog\Logger;
use Monolog\Handler\ErrorLogHandler;

class KafkaProducer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kafka:producer';

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
        echo 'start';

        $logger = new Logger('my_logger', [
            new ErrorLogHandler()
        ]);

        $config  = ProducerConfig::getInstance();
        $config->setMetadataRefreshIntervalMs(1000);
        $config->setMetadataBrokerList('ha01:9092');
        $config->setBrokerVersion('1.0.0');
        $config->setRequiredAck(1);
        $config->setIsAsyn(false);
        $config->setProduceInterval(500);
        $config->setRequestTimeout(1000);
//        $producer = new Producer(function(){
//            return [
//                [
//                    'topic' => 'testasdfsafdd',
//                    'value' => 'test....message',
//                    'key' => 'testkey'
//                ]
//            ];
//        });
//        $producer->setLogger($logger);


//        $producer->success(function($result) {
//            var_dump($result);
//            echo 'success';
//        });
//
//        $producer->error(function($errorCode) {
//            var_dump($errorCode);
//            echo 'failure';
//        });
//        $producer->send(true);

        $producer = new Producer();
        $producer->setLogger($logger);
        for($i = 0; $i < 100; $i++) {
            $producer->send([
                [
                    'topic' => 'test1',
                    'value' => 'test1....message.',
                    'key' => '',
                ],
            ]);
        }

    }
}
