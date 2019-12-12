<?php
namespace Example\Modules\Store;

use Ray\Di\AbstractModule;
use Ray\Di\Scope;

final class StoreModule extends AbstractModule
{
    protected function configure()
    {
        $this->bind(StoreInterface::class)->to(Store::class)->in(Scope::SINGLETON);
        $this->bind()->annotatedWith('redis_scheme')->toInstance($_ENV['REDIS_SCHEME']);
        $this->bind()->annotatedWith('redis_host')->toInstance($_ENV['REDIS_HOST']);
        $this->bind()->annotatedWith('redis_port')->toInstance($_ENV['REDIS_PORT']);
    }
}