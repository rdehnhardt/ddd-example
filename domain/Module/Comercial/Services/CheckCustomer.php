<?php

namespace Domain\Module\Comercial\Services;

use Domain\Aggregate\CustomerRoot;

class CheckCustomer
{
    /**
     * @var CustomerRoot
     */
    private $customer;

    /**
     * CheckCustomer constructor.
     * @param CustomerRoot $customer
     */
    public function __construct(CustomerRoot $customer)
    {
        $this->customer = $customer;
    }

    public function fire()
    {
        $address = $this->customer->getAddress();
    }
}