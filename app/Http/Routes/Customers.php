<?php

namespace App\Http\Routes;

use App\Http\Controllers\Customers\InvalidateController;
use League\Route\RouteCollection;
use League\Route\RouteGroup;

/**
 * Class Customers
 * @package App\Http\Routes
 */
class Customers
{
    /**
     * Map routes
     *
     * @param RouteCollection $route
     * @return RouteGroup
     */
    public function map(RouteCollection $route): RouteGroup
    {
        return $route->group('/customers', function ($route) {
            $route->get('/invalidate', [InvalidateController::class, 'index']);
        });
    }
}
