<?php

namespace Guilhermecvm\Pagarme;

use Guilhermecvm\Pagarme\Exceptions\RequestException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;

abstract class RestClient
{
    public static function request($method, $uri = null, array $options = [])
    {
        $client = new Client();

        try {
            return $client->request($method, $uri, $options);
        } catch (TransferException $e) {
            if ($e->hasResponse()) {
                throw new RequestException(json_decode($e->getResponse()->getBody(), true));
            }
            else {
                throw new RequestException();
            }
        }
    }
}
