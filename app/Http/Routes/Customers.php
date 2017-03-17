<?php

namespace App\Http\Routes;

use App\Http\Controllers\Customers\InvalidateController;
use League\Route\RouteCollection;

class Customers
{
    /**
     * Map routes
     *
     * @param RouteCollection $route
     * @return mixed
     */
    public function map(RouteCollection $route)
    {
        $route->group('/customers', function ($route) {
            $route->get('/invalidate', [InvalidateController::class, 'index']);
        });
    }
}
