<?php

namespace App\Commands;

use App\Contracts\Command;
use Domain\Service\Customer\InvalidateOld;

class InvalidateCustomerCommand implements Command
{
    /**
     * @var InvalidateOld
     */
    private $invalidateOld;

    /**
     * InvalidateCustomerCommand constructor.
     * @param InvalidateOld $invalidateOld
     */
    public function __construct(InvalidateOld $invalidateOld)
    {
        $this->invalidateOld = $invalidateOld;
    }

    /**
     * @return bool
     */
    public function handle(): bool
    {
        return $this->invalidateOld->fire();
    }
}
