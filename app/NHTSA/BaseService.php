<?php

namespace App\NHTSA;


use GuzzleHttp\Client;

/**
 * @property Client client
 */
abstract class BaseService
{
    protected $client;
    /**
     * BaseService constructor.
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_url' => config('nhtsa.api_base_url')
        ]);
    }
}