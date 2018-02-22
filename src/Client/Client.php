<?php

namespace Client;

use Client\API\Authentication;
use Client\API\Items;
use MockAPI\API;
use Psr\Cache\CacheItemPoolInterface;

/**
 * Class Client
 * @package Client
 */
class Client
{
    private const TOKEN_CACHE_KEY = 'token_cache';
    private const TOKEN_EXPIRES_AT_BUFFER = 10;

    /**
     * @var \MockAPI\API
     */
    public $api;

    /**
     * @var null|\Client\Model\Token
     */
    protected $token;

    /**
     * @var \Client\API\Authentication
     */
    protected $authentication;

    /**
     * @var \Psr\Cache\CacheItemPoolInterface
     */
    protected $cachePool;

    /**
     * @var \Client\API\Items
     */
    public $items;

    /**
     * @param \MockAPI\API $api
     * @param \Psr\Cache\CacheItemPoolInterface $cacheItemPool
     */
    public function __construct(API $api, CacheItemPoolInterface $cacheItemPool)
    {
        $this->api = $api;
        $this->cachePool = $cacheItemPool;

        $this->authentication = new Authentication($this);
        $this->items = new Items($this);
    }

    /**
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function ensureValidToken()
    {
        if (!$this->token || $this->token->getExpiresAt() < time() - self::TOKEN_EXPIRES_AT_BUFFER) {
            $cacheItem = $this->cachePool->getItem(self::TOKEN_CACHE_KEY);
            if (!$cacheItem->isHit()) {
                $this->token = $this->authentication->getToken();

                $this->cachePool->save($cacheItem
                    ->set($this->token)
                    ->expiresAt(
                        (new \DateTime())
                            ->setTimestamp($this->token->getExpiresAt() - self::TOKEN_EXPIRES_AT_BUFFER)
                    )
                );
            }
        }
    }

    /**
     * @param string $path
     * @param array $data
     * @return array
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function get(string $path, array $data = [])
    {
        $this->ensureValidToken();

        return $this->api->{'get_' . $path}($this->token->getToken(), $data);
    }

    /**
     * @param string $path
     * @param array $data
     * @return array
     * @throws \Psr\Cache\InvalidArgumentException
     */
    public function post(string $path, array $data = [])
    {
        $this->ensureValidToken();

        return $this->api->{'post_' . $path}($this->token->getToken(), $data);
    }
}