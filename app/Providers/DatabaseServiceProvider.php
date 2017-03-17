<?php

namespace App\Providers;

use App\Db;
use dibi;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;

class DatabaseServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    /**
     * Method will be invoked on registration of a service provider implementing
     * this interface. Provides ability for eager loading of Service Providers.
     *
     * @return void
     * @throws \InvalidArgumentException
     */
    public function boot()
    {
        $this->getContainer()->add(Db::class, function () {
            return new Db([
                'database_type' => getenv('DB_TYPE'),
                'database_name' => getenv('DB_BASE'),
                'server' => getenv('DB_HOST'),
                'username' => getenv('DB_USER'),
                'password' => getenv('DB_PASS'),
                'charset' => 'utf8'
            ]);
        });
    }

    /**
     * Use the register method to register items with the container via the
     * protected $this->container property or the `getContainer` method
     * from the ContainerAwareTrait.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}