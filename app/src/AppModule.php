<?php
namespace Example;

use Example\Modules\Store\StoreModule;
use Ray\Di\AbstractModule;

final class AppModule extends AbstractModule
{
    protected function configure()
    {
        $this->install(new StoreModule());
    }
}