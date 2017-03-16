<?php

namespace Domain\Service\Customer;

use Carbon\Carbon;
use Domain\Repository\Customers;

class InvalidateOld
{
    /**
     * @var Customers
     */
    private $customers;

    /**
     * InvalidateOld constructor.
     * @param Customers $customers
     */
    public function __construct(Customers $customers)
    {
        $this->customers = $customers;
    }

    /**
     * @return bool
     */
    public function fire()
    {
        try {
            $customers = $this->customers->getFromLastAccess(Carbon::now()->subYears(1));

            foreach ($customers as $customer) {
                $customer->setActive(false);

                $this->customers->update($customer);
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}