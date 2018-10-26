<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Kafka\Consumer;
use Kafka\ConsumerConfig;
use Monolog\Logger;
use Monolog\Handler\ErrorLogHandler;

class KafkaConsumer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kafka:consumer';

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

        $logger  = new Logger('my_logger');
        $logger->pushHandler(new ErrorLogHandler());

        $config = ConsumerConfig::getInstance();
        $config->setMetadataBrokerList('ha01:9092');
        $config->setMetadataRefreshIntervalMs(10000);
        $config->setGroupId('test');
    //    $config->setBrokerVersion('1.0.0');
        $config->setTopics(['test1']);
        $consumer = new Consumer();
        $consumer->setLogger($logger);
        $consumer->start(function($topic, $part, $message){
            var_dump($message);
        });


    }
}
