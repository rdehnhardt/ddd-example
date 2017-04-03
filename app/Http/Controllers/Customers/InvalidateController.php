<?php

namespace App\Http\Controllers\Customers;

use Domain\Service\Customer\Invalidate;

class InvalidateController
{
    /**
     * @var Invalidate
     */
    private $invalidate;

    /**
     * InvalidateController constructor.
     * @param Invalidate $invalidate
     */
    public function __construct(Invalidate $invalidate)
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
