<?php
namespace Example\Modules\Store;

use Predis\Client;
use Ray\Di\Di\Named;

final class Store implements StoreInterface
{
    private $client;

    /**
     * @Named("scheme=redis_scheme,host=redis_host,port=redis_port")
     */
    public function __construct(string $scheme, string $host, int $port)
    {
        $this->client = new Client([
            'scheme' => $scheme,
            'host' => $host,
            'port' => $port,
        ]);
    }

    public function get(string $id)
    {
        return json_decode($this->client->get($id), true);
    }

    public function set(string $id, $value)
    {
        $this->client->set($id, json_encode($value));
    }
}