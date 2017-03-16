<?php

namespace Domain\Aggregate;

use Domain\Entity\Address;
use Domain\Entity\Customer;

class CustomerRoot extends Customer
{
    /**
     * @var array
     */
    private $address;

    /**
     * @return array
     */
    public function getAddress(): array
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function addAddress(Address $address)
    {
        $this->address = $address;
    }
}
