<?php

namespace Client\API;

use Client\Client;
use Client\Model\Item;

/**
 * Class Items
 * @package Client\API
 */
class Items
{
    /**
     * @var \Client\Client
     */
    private $client;

    /**
     * Items constructor.
     * @param \Client\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return \Client\Model\Item[]
     * @throws \Psr\Cache\InvalidArgumentException
     * @throws \Exception
     */
    public function getItems(): array
    {
        $response = $this->client->get('items');

        if ($response['success'] === true) {
            return array_map(function (array $item) {
                return Item::fromData($item);
            }, $response['items']);
        }

        throw new \Exception('Could not load items.');
    }

    /**
     * @param \Client\Model\Item $item
     * @return \Client\Model\Item
     * @throws \Psr\Cache\InvalidArgumentException
     * @throws \Exception
     */
    public function addItem(Item $item): Item
    {
        $response = $this->client->post('add_item', ['item' => $item->toArray()]);
        if ($response['success'] === true) {
            return Item::fromData($response['item']);
        }

        throw new \Exception('Item could not be added.');
    }
}