<?php

namespace Domain\Module\Financial\Services;

use Domain\Aggregate\CustomerFinancial;

class CheckCustomer
{
    /**
     * @var CustomerRoot
     */
    private $customer;

    /**
     * CheckCustomer constructor.
     * @param CustomerFinancial $customer
     */
    public function __construct(CustomerFinancial $customer)
    {
        $this->customer = $customer;
    }

    public function fire()
    {
        $bills = $this->customer->getBills();
    }
}