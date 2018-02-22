<?php

namespace Client\API;

use Client\Client;
use Client\Model\Token;

/**
 * Class Authentication
 * @package Client\API
 */
class Authentication
{
    /**
     * @var \Client\Client
     */
    private $client;

    /**
     * Authentication constructor.
     * @param \Client\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return \Client\Model\Token
     */
    public function getToken(): Token
    {
        return Token::fromData($this->client->api->get_token());
    }
}