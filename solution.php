<?php

require_once './vendor/autoload.php';

$api = new \MockAPI\API();

$client = new \Client\Client($api, new \Cache\Adapter\PHPArray\ArrayCachePool());

echo 'Expecting 2 Items.' . PHP_EOL;
$items = $client->items->getItems();
if (count($items === 2)) {
    echo 'Success!' . PHP_EOL;
}

echo 'Adding new Item.' . PHP_EOL;

$item = new \Client\Model\Item();
$item->setTitle('foobar');
$item->setPrice(1.12);

$item = $client->items->addItem($item);
echo 'Success!' . PHP_EOL;
echo 'Item: ' . json_encode($item->toArray()) . PHP_EOL;

