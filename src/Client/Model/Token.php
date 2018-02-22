<?php

namespace Client\Model;

/**
 * Class Token
 * @package Client\Model
 */
class Token
{
    /**
     * @var string
     */
    protected $token;

    /**
     * @var int
     */
    protected $expiresAt;

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return Token
     */
    public function setToken(string $token): Token
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return int
     */
    public function getExpiresAt(): int
    {
        return $this->expiresAt;
    }

    /**
     * @param int $expiresAt
     * @return Token
     */
    public function setExpiresAt(int $expiresAt): Token
    {
        $this->expiresAt = $expiresAt;

        return $this;
    }

    /**
     * @param array $data
     * @return \Client\Model\Token
     */
    public static function fromData(array $data)
    {
        $self = (new self())
            ->setToken($data['token'])
            ->setExpiresAt($data['expires_at']);

        return $self;
    }
}