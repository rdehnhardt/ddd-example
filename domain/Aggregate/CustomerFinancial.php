<?php

namespace Domain\Aggregate;

use Domain\Entity\Address;
use Domain\Entity\Customer;

class CustomerFinancial extends CustomerRoot
{
    /**
     * @var array
     */
    private $bills;

    /**
     * @return array
     */
    public function getBills(): array
    {
        return $this->bills;
    }

    /**
     * @param array $bills
     */
    public function setBills(array $bills)
    {
        $this->bills = $bills;
    }
}
