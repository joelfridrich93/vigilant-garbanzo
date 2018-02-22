<?php

namespace MockAPI;

/**
 * Class API
 * @package MockAPI
 */
class API
{
    /**
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

    protected $lastId = 2;

    /**
     * @return array
     */
    public function get_token()
    {
        return [
            'token' => 'secret-access-token', // string
            'expires_at' => time() + 180 // integer/unix-timestamp = token is 3 minutes valid
        ];
    }

    /**
     * @param string $token
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public function get_items(string $token, array $data = [])
    {
        if ($token !== 'secret-access-token') {
            throw new \Exception('Unauthorized.');
        }

        return [
            'success' => true,
            'items' => $this->items,
        ];
    }

    /**
     * @param string $token
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public function post_add_item(string $token, array $data): array
    {
        if ($token !== 'secret-access-token') {
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
}