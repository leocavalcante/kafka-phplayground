# Kafka PHPlayground

🎸 Just some fun with [Kafka](https://kafka.apache.org/), [PHP](https://www.php.net/) and [Swoole](https://www.swoole.co.uk/).

> Apache Kafka is an open-source distributed event streaming platform used by thousands of companies for high-performance data pipelines, streaming analytics, data integration, and mission-critical applications.

> Swoole is a Coroutine based Async PHP Programming Framework to Build high-performance, scalable, concurrent TCP, UDP, Unix Socket, HTTP, WebSocket services with PHP and fluent Coroutine API.

## Requirements

- PHP >= 7.4 (https://launchpad.net/~ondrej/+archive/ubuntu/php)
- Swoole >= 4.5 (https://www.swoole.co.uk/docs/get-started/installation)
- Java >= 8 (https://openjdk.java.net/install/)

## Instructions

### Kafka

- Download it from https://kafka.apache.org/downloads
- Extract to `<project root>/kafka`
  - `test -f kafka/bin/kafka-server-start.sh && echo OK` (should print `OK`).

#### Start the services

- `kafka/bin/zookeeper-server-start.sh kafka/config/zookeeper.properties`
- `kafka/bin/kafka-server-start.sh kafka/config/server.properties`

#### Create a topic

- `kafka/bin/kafka-topics.sh --create --topic my-topic --bootstrap-server localhost:9092`
  - `Created topic my-topic.` should be the response 

### PHP

#### If you don't have Swoole already:

- `pecl install swoole`

#### Install dependencies

Mainly https://github.com/easy-swoole/kafka

- `composer install`

#### Start the consumer

- `php consumer.php` 

## Let's play!

### Write some events

- `kafka/bin/kafka-console-producer.sh --topic my-topic --bootstrap-server localhost:9092`

Then just type some messages to the stdin. Press `Ctrl+C` to stop.

![Screenshot 01](assets/screenshot-01.png)

### A PHP producer

Just checkout [`producer.php`](producer.php).

![Screenshot 02](assets/screenshot-02.png)

## Let's Rock

### Easy

![Screenshot 03](assets/screenshot-03.png)

![Screenshot 04](assets/screenshot-04.png)

### Medium

![Screenshot 05](assets/screenshot-05.gif)

### Hard

![Screenshot 06](assets/screenshot-06.gif)

> ⚠ Actually, I'm not sure if this is rocking. If you have a proper way to benchmark a consumer, please [issue me](https://github.com/leocavalcante/kafka-phplayground/issues).
