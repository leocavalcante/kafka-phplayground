<?php declare(strict_types=1);

use EasySwoole\Kafka\Config\ConsumerConfig;
use EasySwoole\Kafka\Kafka;
use Swoole\Coroutine as Co;

require_once __DIR__ . '/vendor/autoload.php';

Co\run(static function (): void {
    $consumer = new ConsumerConfig();
    $consumer->setMetadataBrokerList('127.0.0.1:9092');
    $consumer->setGroupId('my-group-id');
    $consumer->setTopics(['my-topic']);

    $kafka = new Kafka($consumer);
    $kafka->consumer()->subscribe(static function (string $topic, int $partition, array $event): void {
        newrelic_start_transaction('Kafka Consumer');
        newrelic_background_job(true);

        $offset = $event['offset'];
        $size = $event['size'];
        $message = $event['message'];

        $crc = $message['crc'];
        $magic = $message['magic'];
        $attr = $message['attr'];
        $key = $message['key'];
        $value = $message['value'];

        echo $value, PHP_EOL;
        newrelic_record_custom_event('Echo', ['value' => $value]);

        newrelic_end_transaction();
    });
});