<?php

namespace Domain\Aggregate;

use Domain\Entity\Address;
use Domain\Entity\Company;

class CompanyRoot extends Company
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
