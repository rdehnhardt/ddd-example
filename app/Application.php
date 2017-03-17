<?php

namespace App;

use League\Container\Container;
use League\Container\ReflectionContainer;
use League\Route\RouteCollection;
use League\Route\Strategy\JsonStrategy;

class Application extends Container
{
    /**
     * @var RouteCollection
     */
    private $router;

    /**
     * Application constructor.
     * @param null $providers
     * @param null $inflectors
     * @param null $definitionFactory
     * @throws \Psr\Container\ContainerExceptionInterface
     */
    public function __construct($providers = null, $inflectors = null, $definitionFactory = null)
    {
        parent::__construct($providers, $inflectors, $definitionFactory);

        $this->delegate(new ReflectionContainer);
        $this->registerServiceProviders();
        $this->registerRoutes();
    }

    /**
     * @param string $path
     * @return string
     */
    public function path(string $path = '')
    {
        return __DIR__ . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }

    /**
     * Configure container service providers
     */
    private function registerServiceProviders()
    {
        foreach (glob($this->path('Providers/*.php')) as $file) {
            $provider = 'App\\Providers\\' . basename($file, '.php');
            $this->addServiceProvider($provider);
        }
    }

    /**
     * Map application routes
     * @throws \Psr\Container\ContainerExceptionInterface
     */
    private function registerRoutes()
    {
        $this->router = new RouteCollection($this);
        $this->router->setStrategy(new JsonStrategy);

        foreach (glob($this->path('Http/Routes/*.php')) as $file) {
            $route = 'App\\Http\\Routes\\' . basename($file, '.php');
            $this->get($route)->map($this->router);
        }
    }

    /**
     * Run the application
     *
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     */
    public function run()
    {
        $response = $this->router->dispatch(
            $this->get('request'),
            $this->get('response')
        );

        $this->get('emitter')->emit($response);
    }
}