<?php

namespace App\Http\Controllers\Customers;

use Domain\Service\Customer\InvalidateOld;

class InvalidateController
{
    /**
     * @var InvalidateOld
     */
    private $invalidate;

    /**
     * InvalidateController constructor.
     * @param InvalidateOld $invalidate
     */
    public function __construct(InvalidateOld $invalidate)
    {
        $this->invalidate = $invalidate;
    }

    /**
     * @return array
     */
    public function index()
    {
        return [
            'executed' => $this->invalidate->fire()
        ];
    }
}
