<?php
namespace Example\Modules\Store;

interface StoreInterface
{
    public function get(string $id);
    public function set(string $id, $value);
}