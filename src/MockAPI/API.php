<?php

namespace MockAPI;

/**
 * ATTENTION: don´t modify this file.
 *
 * Class API
 * Simple "API" which returns array as responses.
 * @package MockAPI
 */
class API
{
    private const TOKEN = 'secret-access-token';

    /**
     * list of items which are "stored" on the api.
     * @var array
     */
    protected $items = [
        [
            'id' => "1", // integer
            'title' => 'Item 1', // string
            'price' => "10.2", // float
        ],
        [
            'id' => "2",
            'title' => 'Item 2',
            'price' => "4.12",
        ],
    ];

    /**
     * @var int $lastId will be incremented when a item is added.
     */
    protected $lastId = 2;

    /**
     * @param string $endpoint
     * @param string $token
     * @param array $data
     * @return array
     */
    public function get(string $endpoint, string $token, array $data): array
    {
        return $this->{'get_' . $endpoint}($token, $data);
    }

    /**
     * @param string $endpoint
     * @param string $token
     * @param array $data
     * @return array
     */
    public function post(string $endpoint, string $token, array $data): array
    {
        return $this->{'post_' . $endpoint}($token, $data);
    }

    /**
     * @return array
     */
    public function get_token(): array
    {
        return [
            'token' => self::TOKEN, // string the access token for the api
            'expires_at' => time() + 180 // integer/unix-timestamp = token is 3 minutes valid
        ];
    }

    /**
     * @param string $token
     * @param array $data
     * @return array
     * @throws \Exception
     */
    protected function get_items(string $token, array $data = []): array
    {
        if ($token !== self::TOKEN) {
            throw new \Exception('Unauthorized.');
        }

        return [
            'success' => true,
            'items' => $this->items,
        ];
    }

    /**
     * @param string $token
     * @param array $data needs to contain a "item" with "price" and "title".
     * @return array
     * @throws \Exception
     */
    protected function post_add_item(string $token, array $data): array
    {
        if ($token !== self::TOKEN) {
            throw new \Exception('Unauthorized.');
        }

        if (isset($data['item'], $data['item']['title'], $data['item']['price'])) {
            $item = $data['item'];
            $item['title'] = (string)$item['title'];
            $item['price'] = (string)$item['price'];
            $item['id'] = ($this->lastId = $this->lastId + 1);

            $this->items[] = $item;

            return [
                'success' => true,
                'item' => $item,
            ];
        }

        return [
            'success' => false,
        ];
    }

    // users endpoints
    // watchlist endpoints
    // ...
}