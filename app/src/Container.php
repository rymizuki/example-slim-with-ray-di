<?php
namespace Example;

use Psr\Container\ContainerInterface;
use Ray\Di\AbstractModule;
use Ray\Di\Injector;

final class Container implements ContainerInterface
{
    private $injector;

    public function __construct(AbstractModule $module)
    {
        $this->injector = new Injector($module);
    }

    /**
     * @inheritDoc
     */
    public function get($id)
    {
        return $this->injector->getInstance($id);
    }

    /**
     * @inheritDoc
     */
    public function has($id)
    {
        try {
            $this->get($id);
            return true;
        } catch (\Throwable $e) {
            return false;
        }
    }
}