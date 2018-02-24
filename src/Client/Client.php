<?php

namespace Client;

use Client\API\Authentication;
use Client\API\Items;
use Client\Model\Token;
use MockAPI\API;
use Psr\Cache\CacheItemPoolInterface;

/**
 * Class Client
 * @package Client
 */
class Client
{
    private const TOKEN_CACHE_KEY = 'token_cache';

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
     * @throws \Exception
     */
    public function ensureValidToken()
    {
        if (!$this->token || !$this->token->isValid()) {
            $cacheItem = $this->cachePool->getItem(self::TOKEN_CACHE_KEY);
            if (!$cacheItem->isHit()) {
                $token = $this->authentication->getToken();
                $this->cachePool->save(
                    $cacheItem
                        ->set($token)
                        ->expiresAt(
                            (new \DateTime)->setTimestamp($token->getExpiresAt() - Token::TOKEN_EXPIRES_AT_BUFFER)
                        )
                );
            }

            $this->token = $cacheItem->get();
            if (!$this->token->isValid()) {
                throw new \Exception('Could not ensure an valid access token.');
            }
        }
    }

    /**
     * @param string $endpoint
     * @param array $data
     * @return array
     * @throws \Psr\Cache\InvalidArgumentException
     * @throws \Exception
     */
    public function get(string $endpoint, array $data = [])
    {
        $this->ensureValidToken();

        return $this->api->get($endpoint, $this->token->getToken(), $data);
    }

    /**
     * @param string $endpoint
     * @param array $data
     * @return array
     * @throws \Psr\Cache\InvalidArgumentException
     * @throws \Exception
     */
    public function post(string $endpoint, array $data = [])
    {
        $this->ensureValidToken();

        return $this->api->post($endpoint, $this->token->getToken(), $data);
    }
}