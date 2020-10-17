<?php declare(strict_types=1);

use EasySwoole\Kafka\Config\ProducerConfig;
use EasySwoole\Kafka\Producer\Process;
use Swoole\Coroutine as Co;

require_once __DIR__ . '/vendor/autoload.php';

Co\run(static function (int $n, int $c): void {
    $config = new ProducerConfig();
    $config->setMetadataBrokerList('127.0.0.1:9092');

    while ($n--) {
        $events = array_map(static fn(int $i) => [
            'topic' => 'my-topic',
            'value' => "$n:$i",
        ], range(1, $c));

        (new Process($config))->send($events);
    }
}, (int)$argv[1], (int)$argv[2]);