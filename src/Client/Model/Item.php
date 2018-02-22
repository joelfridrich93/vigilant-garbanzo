<?php

namespace Client\Model;

/**
 * Class Item
 * @package Client\Model
 */
class Item
{
    /**
     * @var int|null
     */
    protected $id;

    /**
     * @var string|null
     */
    protected $title;

    /**
     * @var float|null
     */
    protected $price;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Item
     */
    public function setId(?int $id): Item
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param null|string $title
     * @return Item
     */
    public function setTitle(?string $title): Item
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     * @return Item
     */
    public function setPrice(?float $price): Item
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'price' => $this->getPrice(),
        ];
    }

    /**
     * @param array $data
     * @return \Client\Model\Item
     */
    public static function fromData(array $data)
    {
        $self = (new self())
            ->setId($data['id'] ?? null)
            ->setTitle($data['title'] ?? null)
            ->setPrice($data['price'] ?? null);

        return $self;
    }
}