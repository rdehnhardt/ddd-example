<?php

namespace Domain\Entity;

use Carbon\Carbon;
use Domain\ValueObject\Email;

class Address
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $street;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet(string $street)
    {
        $this->street = $street;
    }
}