<?php declare(strict_types=1);

use EasySwoole\Kafka\Config\ProducerConfig;
use EasySwoole\Kafka\Kafka;
use Swoole\Coroutine as Co;

require_once __DIR__ . '/vendor/autoload.php';

Co\run(static function (): void {
   $producer = new ProducerConfig();
   $producer->setMetadataBrokerList('127.0.0.1:9092');

   $kafka = new Kafka($producer);

   while (true) {
       $message = trim(fgets(STDIN));

       $event = [
           'topic' => 'my-topic',
           'value' => $message,
       ];

       $kafka->producer()->send([$event]);
   }
});